<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TrainingTarget;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TrainingTargetController extends Controller
{
    public function index()
    {
        return view('training-targets.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = TrainingTarget::with('user')->select('training_targets.*');
        return $datatables->eloquent($query)
        ->addColumn('user', function ($training_target) {
            return $training_target->user->name;
        })

        ->addColumn('achieved_hour', function ($training_target) {
            if($training_target->achieved_hour)
                {
                    $hour = floor($training_target->achieved_hour / 60);
                    $minute = ($training_target->achieved_hour % 60);
                    return $hour.':'.$minute;
                } 
            return '0:0';
        })
          
        ->addColumn('action', function ($training_target) {
            return view('training-targets.actions', ['training_target' => $training_target]);
        })
        ->make(true);
    }

    public function status()
    {   
        return view('training-targets.status');
    }

    public function statusData(Datatables $datatables)
    {
        if(auth()->user()->hasRole('trainer'))
        {
            $query = TrainingTarget::where('user_id','=',auth()->user()->id)
            ->where('training_targets.active_status','=','1')
            ->orderBy('started_at','DESC')
            ->select('training_targets.*');
            return $datatables->eloquent($query)

            ->addColumn('remain_hours', function ($training_target) {
                $return_string = '';
                $total_minute = ($training_target->target_hour * 60) - $training_target->achieved_hour;
                if ($total_minute < 0) {
                    $return_string .= '-';
                    $total_minute = abs($total_minute);
                }
                $hours = floor($total_minute / 60);
                $minute = ($total_minute % 60);
                // dd($total_minute."--". $hours."--". $minute);
                $return_string .= $hours . ':' . $minute;

                return $return_string;                            
            })

            ->addColumn('achived_hours',function($training_target){
               // return $training_target->achieved_hour;
                if($training_target->achieved_hour)
                {
                    $hour = floor($training_target->achieved_hour / 60);
                    $minute = ($training_target->achieved_hour % 60);
                    return $hour.':'.$minute;
                } 
                return '0:0';
            })
            ->make(true);
        }
        else
        {
            $query = TrainingTarget::with('user')->select('training_targets.*');
            
            return $datatables->eloquent($query)

            ->addColumn('user_name', function ($training_target) {
              return $training_target->user->name;
            })

            ->addColumn('achived_hours',function($training_target){
                if ($training_target->achieved_hour) {
                    $hour = floor($training_target->achieved_hour / 60);
                    $minute = ($training_target->achieved_hour % 60);
                    return $hour.':'.$minute; 
                }
                return '0:0';
            })

            ->addColumn('remain_hours', function ($training_target) {
                $return_string = '';
                $total_minute = ($training_target->target_hour*60) - $training_target->achieved_hour;
                if($total_minute < 0){
                    $return_string .= '-';
                    $total_minute = abs($total_minute);
                }
                $hours = floor($total_minute / 60);
                $minute = ($total_minute % 60);
                    // dd($total_minute."--". $hours."--". $minute);
                $return_string .=  $hours.':'.$minute;

                return $return_string;
            })
            ->make(true);     
        }
    }

    public function create(Request $request)
    {
        $users = User::where('is_active', true)
        ->where('company_id', auth()->user()->company->id)
        ->wherehas('roles', function($query){
            $query->where('name', 'trainer');
        })
        ->pluck('name', 'id');
        return view('training-targets.create', compact('users'));
    }
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'user_id' => 'required',
            'started_at' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if(!empty($request->started_at) && !empty($request->ended_at)){
                        $started_at = Carbon::parse($request->started_at);
                        $ended_at = Carbon::parse($request->ended_at)->addSecond(59);
                        if(!$started_at->gt($ended_at)){
                            $current_targets_count = TrainingTarget::where('user_id', $request->user_id)
                            // ->whereBetween('started_at', [$request->started_at, $request->ended_at])
                            // ->orWhereBetween('ended_at', [$request->started_at, $request->ended_at])
                            ->where('started_at', $started_at)
                            ->where('ended_at', $ended_at)
                            ->where('target_hour', $request->target_hour)
                            ->count();
                            // dd($current_targets_count);
                            if($current_targets_count){
                                // return $fail("The target period overlaps with previously set targets");
                                return $fail("This target is already assigned");
                            }

                            $current_targets_count = TrainingTarget::where('user_id', $request->user_id)
                                ->Where(function ($query) use ($started_at, $ended_at) {
                                    $query->whereRaw('? between `started_at` and `ended_at`', [$started_at])
                                        ->orWhereRaw('? between `started_at` and `ended_at`', [$ended_at]);
                                })
                                ->count();
                            // dd($current_targets_count);
                            if ($current_targets_count) {
                                // return $fail("The target period overlaps with previously set targets");
                                return $fail("This user has target within this time-slot");
                            }
                        }
                    }
                }
            ],
            'ended_at' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if(!empty($request->started_at) && !empty($request->ended_at)){
                        $started_at = Carbon::parse($request->started_at);
                        $ended_at = Carbon::parse($request->ended_at);
                        if($started_at->gt($ended_at)){
                            return $fail("End date should be greater than start date");
                        }
                    }
                }
            ],
            'target_hour' => 'required'
        ], [
            'user_id.required' => 'User is required',
            'started_at.required' => 'From Date is required',
            'ended_at.required' => 'To Date is required',
            'target_hour.required' => 'Target hour is required'
        ]);
        // dd($request->all());
        $training_target = new TrainingTarget();
        $training_target->fill($request->all() + ['active_status' => 1]);
        $training_target->user()->associate($request->user_id);
        $training_target->save();
        return ["success" => "Training target created Successfully"];
    }

    public function edit($id)
    {
        $users = User::where('is_active', true)
        ->where('company_id', auth()->user()->company->id)
        ->wherehas('roles', function($query){
            $query->where('name', 'trainer');
        })
        ->pluck('username', 'id');
        $training_target = TrainingTarget::find($id);
        return view('training-targets.edit', ['training_target' => $training_target, 'users' => $users]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'started_at' => 'required',
            'ended_at' => [
                'required',
                function ($attribute, $value, $fail) use ($request, $id) {
                    if(!empty($request->started_at) && !empty($request->ended_at)){
                        $started_at = Carbon::parse($request->started_at);
                        $ended_at = Carbon::parse($request->ended_at);
                        if($started_at->gt($ended_at)){
                            return $fail("End date should be greater than start date");
                        }

                        $current_targets_count = TrainingTarget::where('user_id', $request->user_id)
                            // ->whereBetween('started_at', [$request->started_at, $request->ended_at])
                            // ->orWhereBetween('ended_at', [$request->started_at, $request->ended_at])
                            ->where('started_at', $request->started_at)
                            ->where('ended_at', $request->ended_at)
                            ->where('target_hour', $request->target_hour)
                            ->count();
                        if ($current_targets_count) {
                                // return $fail("The target period overlaps with previously set targets");
                            return $fail("This target is already assigned");
                        }

                        $current_targets_count = TrainingTarget::where('user_id', $request->user_id)
			                ->where('id', '!=', $id)
                            ->Where(function ($query) use ($request) {
                                $query->whereRaw('? between `started_at` and `ended_at`', [$request->started_at])
                                    ->orWhereRaw('? between `started_at` and `ended_at`', [$request->ended_at]);
                            })
                            ->count();
                        if ($current_targets_count) {
                                // return $fail("The target period overlaps with previously set targets");
                            return $fail("This user has target within this time-slot");
                        }


                    }
                }
            ],
            'target_hour' => 'required'
        ], [
            'user_id.required' => 'User is required',
            'started_at.required' => 'From Date is required',
            'ended_at.required' => 'To Date is required',
            'target_hour.required' => 'Target hour is required'
        ]);
        $training_target = TrainingTarget::find($id);
        $training_target->fill($request->all() + ['active_status' => 1]);
        $training_target->user()->associate($request->user_id);
        $training_target->save();
        return ["success" => "Training target updated Successfully"];
    }

    public function delete($id)
    {
        $training_target = TrainingTarget::find($id);
        return view('training-targets.delete', ['training_target' => $training_target]);
    }
    public function destroy($id)
    {
        // $user = TrainingTarget::find($id);
        // $user->delete();
        TrainingTarget::where('id',$id)->update(['active_status' => 0]);
        return ["success" => "TrainingTarget Deleted Successfully"];
    }
}
