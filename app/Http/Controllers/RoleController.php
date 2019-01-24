<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Permission;
use App\Category;
use App\Role;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }
    public function indexData(Datatables $datatables)
    {
        $query = Role::with('permissions')
        ->whereNotIn('roles.name', ['Airtel_sa', 'Robi_sa'])
        ->where('roles.company_id', '=', auth()->user()->company->id)
        ->select('roles.*');
        return $datatables->eloquent($query)
                      ->addColumn('permissions', function($role){
                          return $role->permissions->implode('display_name', ", ");
                      })
                      ->addColumn('qty', function($role){
                          return $role->qty;
                      })
                      ->addColumn('action', function ($role) {
                          return view('roles.users-action', ['role' => $role]);
                      })
                      ->rawColumns(['name', 'action'])
                      ->make(true);
    }
    public function create()
    {
        $permissions = Permission::orderBy('display_name')->pluck('display_name', 'id');
        $categories = Category::where('company_id', auth()->user()->company->id)->orderBy('name')->pluck('name', 'id');
        return view('roles.create', ['permissions' => $permissions, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
          'display_name' => [
            'required',
            Rule::unique('roles')->where(function ($query) use($request) {
              $name = auth()->user()->company->name . '_' . $request->display_name;
              return $query->where('name', $name)->exists();
            })
          ]
        ]);
        $role = Role::create([
            'display_name' =>  $request->display_name,
            'name' => auth()->user()->company->name . '_' . $request->display_name,
            'company_id' => auth()->user()->company->id,
            'guard_name' => 'admin'
        ]);
        $role->permissions()->sync($request->permissions);

        $role->categories()->sync($request->categories);

        return redirect('roles')->with('success', 'Role saved Successfully');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::orderBy('display_name')->pluck('display_name', 'id');
        $categories = Category::where('company_id', auth()->user()->company->id)
        ->orderBy('name')
        ->pluck('name', 'id');
        return view('roles.edit', ["role" => $role, 'permissions' => $permissions, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'display_name' => [
            'required',
            Rule::unique('roles')->where(function ($query) use($request, $id) {
              $name = auth()->user()->company->name . '_' . $request->display_name;
              return $query->where('name', $name)->where('id', '!=', $id)->exists();
            })
          ]
        ]);

        $role = Role::find($id);
        $role->update([
          'display_name' =>  $request->display_name,
          'name' => auth()->user()->company->name . '_' . $request->display_name,
        ]);

        $role->permissions()->sync($request->permissions);

        $role->categories()->sync($request->categories);

        return redirect()->back()->with('success', 'Roles updated Successfully');
    }

    public function table()
    {
        $roles = Role::orderBy('name', 'asc')
            ->where('display_name', '!=', 'sa')
            ->where('company_id', auth()->user()->company->id)
            ->get();
        $perm_groups = Permission::orderBy('category', 'asc')
                ->orderBy('name', 'asc')
                ->where('category', '<>', 'Permission')
                ->get()
                ->groupBy('category');



        return view('roles.table', ['roles' => $roles, 'perm_groups' => $perm_groups]);
    }

    public function tableUpdate(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        $permission = Permission::find($request->input('perm_id'));

        if ($request->input('role_perm') == 0) {
            $role->revokePermissionTo($permission);
        } else {
            $role->givePermissionTo($permission);
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect('roles')->with('success', 'Role deleted Successfully');
    }
}
