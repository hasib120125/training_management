<?php

namespace App\Http\Controllers;

use Storage;
use Image;
use Validator;
use Hash;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\User;
use App\TrainingUser;
use App\Training;
use App\PasswordHistory;
use App\ContentUser;
use App\ContentHit;
use App\Role;
use App\Permission;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = User::where('company_id', auth()->user()->company_id)
        ->with('roles')
        ->whereNotIn('username', ['robi_admin', 'airtel_admin', 'robi_trainer', 'airtel_trainer'])
        ->orderBy('name', 'ASC')
        ->select('users.*');
        return $datatables->eloquent($query)
          ->addColumn('action', function ($user) {
              return view('users.actions', ['user' => $user]);
          })
          ->addColumn('role', function ($user) {
              return $user->roles->map(function($role){
                return $role->display_name;
              })->implode(", ");
          })
          ->addColumn('registered_at', function ($user) {
              return $user->created_at->toFormattedDateString();
          })
          ->make(true);
    }
    public function create(Request $request)
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
              'name' => 'required',
              'username' => 'required|unique:users',
              'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'not_contains:robi,admin,administrator,' . $request->username
              ],
              'confirm_password' => 'same:password',
            ],
            [
              'first_name.required'=>'The First Name is required',
              'username.required'=>'The Login ID is required',
              'password.min' => 'Password must have at least 8 characters',
              'password.regex' => 'Password must have at least a lowercase, an uppercase, a numeric and a special character',
              'password.not_contains' => 'Password must not contain robi, admin, administrotor and your username'
            ]
        );

        $user = User::create($request->all() + ['company_id' => auth()->user()->company->id]);
        $user->password = bcrypt($request->password);
        $user->save();

        if(auth()->user()->company->id == '1')
        {

          
          $spacial_training = Training::where('id',1)->first();
          
          $result = TrainingUser::insert([
            'user_id' => $user->id,
            'training_id' => $spacial_training->id,
            'started_at' => $spacial_training->started_at,
            'ended_at' => $spacial_training->ended_at,
            'status_id' => '3',
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => '1',
            'updated_by' => '1',
            'active_status' => '1'
          ]);
         
        }
        elseif(auth()->user()->company->id == '2'){
          $spacial_training = Training::where('id',2)->first();
          TrainingUser::insert([
            'user_id' => $user->id,
            'training_id' => $spacial_training->id,
            'started_at' => $spacial_training->started_at,
            'ended_at' => $spacial_training->ended_at,
            'status_id' => '3',
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => '1',
            'updated_by' => '1',
            'active_status' => '1'
          ]);
        }

        $passwordHistory = PasswordHistory::create([
            'user_id' => $user->id,
            'password' => $user->password
        ]);
        $user->assignRole(Role::find($request->role_id));
        return ["success" => "User created Successfully"];
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
              'name' => 'required',
              'username' => 'required|unique:users,username,'.$id,
              'password' => 'nullable|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
              'confirm_password' => 'same:password',
              'not_contains:robi,admin,administrator,' . $request->username
            ],
            [
              'name.required'=>'The First Name is required',
              'username.required'=>'The Login ID is required',
              'password.min' => 'Password must have at least 8 characters',
              'password.regex' => 'Password must have at least a lowercase, an uppercase, a numeric and a special character',
              'password.not_contains' => 'Password must not contain robi, admin, administrotor and your username'
            ]
        );

        $user = User::find($id);
        $user->update($request->except('password', 'is_active', 'is_locked'));

        if (!empty($request->password)) {
            $user->password = bcrypt($request->password);
            $user->save();
            $passwordHistory = PasswordHistory::create([
              'user_id' => $user->id,
              'password' => $user->password
            ]);
        }
        $user->is_active = empty($request->is_active) ? false : true;
        $user->is_locked = empty($request->is_locked) ? false : true;
        $user->save();
        $user->roles()->sync([$request->role_id]);
        return ["success" => "User updated Successfully"];
    }

    public function delete($id)
    {
        $user = User::find($id);
        return view('users.delete', ['user' => $user]);
    }
    public function destroy($id)
    {
        //$user = User::find($id);
        //$user->delete();
        User::where('id',$id)->update(['is_locked' => 1,'is_active' => 0]);
        return ["success" => "User Deleted Successfully"];
    }

    public function getUser(Request $request)
    {
        $user =  auth()->user();
        $user->show_admin_dashboard = $user->hasPermissionTo('admin_dashboard_link');
        $user->manage_contents = $user->hasPermissionTo('manage_contents');
        $user->company_switch = $user->hasPermissionTo('company_switch');
        $user->switch_company = $user->switched_company_id == 1 ? 'Airtel' : 'Robi';
        return $user;
    }

    public function toggleCompany()
    {
        $user = auth()->user();
        $user->switched_company_id = $user->switched_company_id == 1? 2: 1;
        $user->save();
    }
    public function showChangePasswordForm(){
      return view('users.change-password');
    }
    public function changePassword(Request $request)
    {
        $user = $request->user();
        $this->validate(
        $request,
        [
          'current_password' => [
            'required',
            function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail("Current password doesn't match with our record.");
                }
            }
          ],
          'password' => [
              'required',
              'min:8',
              'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
              'not_contains:robi,admin,administrator,' . $user->username,
              function ($attribute, $value, $fail) use ($user) {
                  $passwordHistories = $user->passwordHistories()->take(5)->get();
                  foreach ($passwordHistories as $passwordHistory) {
                      if (Hash::check($value, $passwordHistory->password)) {
                          return $fail("Your new password can not be same as any of your recent passwords. Please choose a new password.");
                      }
                  }
              }
          ],
          'confirm_password' => [
            'required',
            'same:password'
          ]
        ],
        [
          'password.min' => 'Password must have at least 8 characters',
          'password.regex' => 'Password must have at least a lowercase, an uppercase, a numeric and a special character',
          'password.not_contains' => 'Password must not contain robi, admin, administrotor and your username'
        ]
      );
        $user->update([
        'password' => bcrypt($request->password),
        'is_default_password' => false
      ]);

        $passwordHistory = PasswordHistory::create([
        'user_id' => $user->id,
        'password' => $user->password
      ]);
      return redirect()->back()->with('success', 'Password has been changed successfully');
    }

    public function getNames()
    {
       return User::pluck('name','id')->toArray(); 
    }

    public function getTrainer()
    {
      return User::whereNotIn('username', ['robi_admin', 'airtel_admin', 'robi_trainer', 'airtel_trainer'])->pluck('name','id')->toArray();
    }
}
