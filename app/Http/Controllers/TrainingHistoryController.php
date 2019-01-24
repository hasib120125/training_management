<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\TrainingHistory;
use App\User;
use App\Training;
use App\TrainingUser;
use App\TrainingMode;
use App\TrainingTarget;
use App\Status;
use App\TrainingType;
use App\TrainingAudience;
use App\TrainingSystem;
use App\TrainingBrand;
use Excel;
use DB;

class TrainingHistoryController extends Controller
{
    public function index()
    {
        return view('training-histories.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = TrainingHistory::with('training')
        ->with('audience')
        ->with('user')
        ->with('training')
        ->with('status')
        ->with('training_type')
        ->with('training_mode')
        ->with('training_system')
        ->with('training_brand')
        ->orderBy('id','DESC')
        ->select('training_histories.*');
        if(auth()->user()->hasRole('trainer')){
            $query = $query->where('user_id', auth()->user()->id);
        }
        $datatables = $datatables->eloquent($query)
          ->addColumn('user', function ($training_history) {
              if($training_history->user){
                return $training_history->user->name;
              }
              return '';
              
          })
          ->addColumn('status', function ($training_history) {
              $return_string = '';
              if($training_history->status)
              {
                    $return_string = $training_history->status->name;
                    if($training_history->user_duration != $training_history->approved_duration){
                        $return_string = $return_string.':'.'Edited';
                    }

              }
              return $return_string;
             
          })
          ->addColumn('audience', function ($training_history) {
            if($training_history->audience)
            {
              return $training_history->audience->name;  
            }
            return '';                 
          })
          
          ->addColumn('training', function ($training_history) {
              if($training_history->training){
                  return $training_history->training->title;
              }
              return '';
          })

          ->addColumn('training_type', function ($training_history) {
            if($training_history->training_type)
            {
                return $training_history->training_type->name;
            }
            return '';  
            
          })
          ->addColumn('training_mode', function ($training_history) {
            if($training_history->training_mode){  
            return $training_history->training_mode->name;
            }
            return '';
          })
          ->addColumn('training_system', function($training_history){
            if($training_history->training_system)
            {
                return $training_history->training_system->name;
            }
            return '';    
          })
          ->addColumn('training_brand', function($training_history){
            if($training_history->training_brand)
            {
                return $training_history->training_brand->name;
            }
            return '';    
          })
          
          ->addColumn('action', function ($training_history) {
              return view('training-histories.actions', ['training_history' => $training_history]);
          });
          
        return $datatables->make(true);
    }


    public function create(Request $request)
    {        

        // $training_user = TrainingUser::find($request->training_user_id);
        
        // $training = $training_user->training;
        
        // //$special_training_robi = Training::find($training_user->training_id);
        // $special_training_robi = Training::find(1);
        // //$special_training_airtel = Training::find($training_user->training_id);
        // $special_training_airtel = Training::find(2);

        // if($training->id == '1' || $training->id == '2')
        // {
        //     $training_types = TrainingType::where('active_status', 1)->pluck('name','id');
        //     $training_system = TrainingSystem::where('active_status', 1)->pluck('name','id');
        //     //dd('sdafsdf');
        //     //$training_types = TrainingType::where('id',$special_training_robi->training_type_id)->pluck('name','id');
        //    // $training_system = TrainingSystem::where('id',$special_training_robi->training_system)->pluck('name','id'); 
        // }
        // else
        // {
        //    //$training_types = TrainingType::pluck('name','id');
        //    //$training_system = TrainingSystem::pluck('name','id'); 
        //    $training_types = TrainingType::where('id',$training_id->training_type_id)->pluck('name','id');
        //    $training_system = TrainingSystem::where('id',$training_id->training_system)->pluck('name','id'); 
        // }   

        $training_types = TrainingType::where('active_status', 1)->pluck('name', 'id');
        $training_modes = TrainingMode::where('active_status', 1)->orderBy('name')->pluck('name', 'id');
        $training_system = TrainingSystem::pluck('name', 'id'); 
        $training_brands = TrainingBrand::where('active_status', 1)->orderBy('name')->pluck('name','id');
        $audiences = TrainingAudience::where('active_status', 1)->orderBy('name')->pluck('name', 'id');
        
        $training_user = TrainingUser::find($request->training_user_id);
        // $training = $training_user->training;
        // dd($training);

        return view('training-histories.create', compact('users', 'training_modes', 'training_user','audiences','training_types','training_system','training_brands'));
    }

    public function store(Request $request)
    {
        if(auth()->user()->hasRole('trainer')) {
            $this->validate($request, [
                'training_user_id' => 'required',
                'training_mode_id' => 'required',
                'started_at' => [
                    'required',
                    // function ($attribute, $value, $fail) use ($request) {
                    //     if(!empty($request->started_at)
                    //     && !empty($request->ended_at)
                    //     && !empty($request->training_user_id)){
                    //         $started_at = Carbon::parse($request->started_at)->addSecond();
                    //         $ended_at = Carbon::parse($request->ended_at)->subSecond();
                    //         if(!$started_at->gt($ended_at)){
                    //             $training_user = TrainingUser::find($request->training_user_id);
                                
                    //             $training_histories = TrainingHistory::where('user_id', $training_user->user_id)
                    //             ->whereBetween('started_at', [$started_at, $ended_at])
                    //             ->orWhereBetween('ended_at', [$started_at, $ended_at])
                    //             ->orWhere(function($query) use($started_at, $ended_at){
                    //                 $query->where('started_at', '<=', $started_at)
                    //                 ->where('ended_at', '>=', $started_at);
                    //             })                                
                    //             ->orWhere(function($query) use($started_at, $ended_at){
                    //                 $query->where('started_at', '<=', $ended_at)
                    //                 ->where('ended_at', '>=', $ended_at);
                    //             })
                    //             // ->where('status_id', '!=', 7)
                    //             // ->Where(function ($query) use ($started_at, $ended_at) {
                    //             //     $query->whereRaw('? between started_at and ended_at', [$started_at])
                    //             //     ->orWhereRaw('? between started_at and ended_at', [$ended_at]);
                    //             // })
                    //             ->count();
                                
                    //             // dd($training_histories);

                    //             if($training_histories){
                    //                 return $fail("The user have entries during this time period");
                    //             }
                    //         }                           

                    //         if(now()->lt($training_user->started_at)){
                    //             return $fail('the training is not started yet');
                    //         }
                    //     }
                    // }

                    function ($attribute, $value, $fail) use ($request) {
                        if(!empty($request->started_at)
                        && !empty($request->ended_at)
                        && !empty($request->training_user_id)){                            
                            $started_at = Carbon::parse($request->started_at);
                            $ended_at = Carbon::parse($request->ended_at);

                            if($started_at > Carbon::now()){
                                return $fail("Training time cant be in future");
                            }                            
                            else if(!$started_at->gt($ended_at)){
                                $training_user = TrainingUser::find($request->training_user_id);

                                if($started_at < Carbon::parse($training_user->started_at) || $started_at > Carbon::parse($training_user->ended_at)){
                                    return $fail("Training time must be within assigned time");
                                }


                                $training_histories = TrainingHistory::where('user_id', $training_user->user_id)
                                // ->whereBetween('started_at', [$started_at, $ended_at])
                                // ->orWhereBetween('ended_at', [$started_at, $ended_at])
                                // ->orWhere(function($query) use($started_at, $ended_at){
                                //     $query->where('started_at', '<=', $started_at)
                                //     ->where('ended_at', '>=', $started_at);
                                // })
                                // ->orWhere(function($query) use($started_at, $ended_at){
                                //     $query->where('started_at', '<=', $ended_at)
                                //     ->where('ended_at', '>=', $ended_at);
                                // })
                                ->where('training_histories.status_id', '<>', 7)
                                ->Where(function ($query) use ($started_at, $ended_at) {
                                    $query->whereRaw('? between started_at and ended_at', [$started_at])
                                        ->orWhereRaw('? between started_at and ended_at', [$ended_at]);
                                })
                                ->count();
                                if($training_histories){
                                    return $fail("The user have entries during this time period");
                                }
                            }

                            if(!(now()->gt($training_user->started_at)))
                            {
                                return $fail('The training has not started yet');
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
                            if($started_at->gte($ended_at)){
                                return $fail("End date should be greater than start date");
                            }
                            if ($ended_at > Carbon::now()) {
                                return $fail("Training time cant be in future");
                            }

                            $training_user = TrainingUser::find($request->training_user_id);

                            if ($ended_at < Carbon::parse($training_user->started_at)  || $ended_at > Carbon::parse($training_user->ended_at)) {
                                return $fail("Training time must be within assigned time");
                            }
                        }
                    }
                ],
                'user_duration' => 'required',
                'no_of_trainees' => 'required'
            ], [
                'training_id.required' => 'Please select a training',
                'training_mode_id.required' => 'Please select a training Mode',
                'started_at.required' => 'From Date is required',
                'ended_at.required' => 'To Date is required',
                'user_duration.required' => 'Duration is required',
                'no_of_trainees.required' => 'Number of trainees required'
            ]);
        }

        
        // Approved duration is equal to user duration initially
        $request->merge(['approved_duration' => $request->user_duration]);
        $training_user = TrainingUser::find($request->training_user_id);
        $training_history = new TrainingHistory();
        $training_history->fill($request->all());
        if(auth()->user()->hasRole('admin')){
            $training_history->user()->associate($request->user_id);
        }
        if(auth()->user()->hasRole('trainer')){
            $training_history->user()->associate(auth()->user()->id);
        }
        $training_history->training_user()->associate($request->training_user_id);
        $training_history->training()->associate($training_user->training_id);
        $training_history->training_mode()->associate($request->training_mode_id);
        $training_history->training_type()->associate($request->training_type_id);
        $training_history->status()->associate(5);
        
        $training_history->save();

        // $training_target = TrainingTarget::where('user_id', $training_history->user_id)
        // ->where('started_at', '<=', $training_history->started_at)
        // ->where('ended_at', '>=', $training_history->started_at)
        // ->first();
        
        // if($training_target){
             
        //     $trainings_time_duration = TrainingHistory::where('user_id',$training_history->user_id)
        //     ->where('training_user_id',$training_history->training_user_id)
        //     ->whereIn('status_id',[5,6])
        //     ->get();
        //     $totalHr = 0;
        //     $totalMin = 0;
        //     foreach($trainings_time_duration as $key => $times)
        //     {
        //         $time = explode(':',$times->approved_duration);
        //         $hour = trim($time[0])*60;
        //         $minute = trim($time[1]);
            
        //         $totalHr += $hour;
        //         $totalMin += $minute;
        //         $total_minute = $totalHr + $totalMin;
               
        //     }
        //     //dd($total_minute);
        //     // $time = explode(':',$training_history->approved_duration);
            
        //     // $hour = trim($time[0])*60;
        //     // $minute = trim($time[1]);
        //     // $total_approve_duration_minute = $hour + $minute;
            
        //     // $achieved_hours_in_minute = ($training_target->achieved_hour);
        //     // $total_minute = $achieved_hours_in_minute + $total_approve_duration_minute;

        //     $training_target->achieved_hour =  $total_minute;
        //    // $training_target->achieved_hour = $training_target->achieved_hour 
        //    // + $training_history->approved_duration;
        //     $training_target->save();
        // }
    
        return ["success" => "Training history created Successfully"];
    }

    public function edit($id)
    {
        if(auth()->user()->hasRole('admin')){
            $users = User::where('is_active', true)
            ->where('company_id', auth()->user()->company->id)
            ->wherehas('roles', function($query){
                $query->where('name', 'trainer');
            })
            ->pluck('username', 'id');            
        }

        if(auth()->user()->hasRole('trainer')){
            $trainings = Training::where('active_status', 1)->whereHas('training_users', function($query){
                $query->where('user_id', auth()->user()->id);
            })
            ->pluck('title','id');
        }
        

        
		
        // $training_type_val = TrainingHistory::where('id',$id)->first();
        $training_history = TrainingHistory::find($id);
        
		$training_types = TrainingType::where('id', $training_history->training_type_id)->pluck('name','id');
        $training_modes = TrainingMode::where('active_status', 1)->orderBy('name')->pluck('name', 'id');        
        $training_system = TrainingSystem::where('active_status', 1)->orderBy('name')->pluck('name','id');
        $training_brands = TrainingBrand::where('active_status', 1)->orderBy('name')->pluck('name','id');
        $audiences = TrainingAudience::where('active_status', 1)->orderBy('name')->pluck('name', 'id');

        // $training_history = TrainingHistory::find($id);

        if(auth()->user()->hasRole('admin')){
            $statuses = Status::where('whose','training_history')->pluck('display_name','id');
        }
                
        return view('training-histories.edit', compact('training_history', 'users', 'training_modes','training_types','trainings','statuses','audiences','training_system','training_brands'));
    }

    public function update(Request $request, $id)
    {

        //dd($request->status_id);
        // if(auth()->user()->hasRole('trainer')) {
            $this->validate($request, [
                'training_mode_id' => 'required',
                'started_at' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request, $id) {
                        if(!empty($request->started_at)
                        && !empty($request->ended_at)){
                            $started_at = Carbon::parse($request->started_at);
                            $ended_at = Carbon::parse($request->ended_at);

                            if ($started_at > Carbon::now()) {
                                return $fail("Training time cant be in future");
                            }

                            if(!$started_at->gt($ended_at)){
                                $training_history = TrainingHistory::find($id);
                                $training_histories = TrainingHistory::where('user_id', $training_history->user_id)
                                ->where('id', '!=', $id)
                                ->where('training_histories.status_id', '<>', 7)
                                // ->where(function($query) use ($started_at, $ended_at){

                                //     $query->whereBetween('started_at', [$started_at, $ended_at])
                                //     ->orWhereBetween('ended_at', [$started_at, $ended_at])
                                //     ->orWhere(function($query) use($started_at, $ended_at){
                                //         $query->where('started_at', '<=', $started_at)
                                //         ->where('ended_at', '>=', $started_at);
                                //     });
                                // })                                
                                ->Where(function ($query) use ($started_at, $ended_at) {
                                    $query->whereRaw('? between started_at and ended_at', [$started_at])
                                        ->orWhereRaw('? between started_at and ended_at', [$ended_at]);
                                })
                                ->count();
                                // dd($training_histories);
                                if($training_histories){
                                    return $fail("User have entries during this time period");
                                }

                                $training_histories = TrainingHistory::where('user_id', $training_history->user_id)
                                ->where('id', '=', $id)
                                ->where('training_histories.status_id', '=', 6)
                                ->count();
                                // dd($training_histories);
                                if ($training_histories) {
                                    return $fail("Its already Approved");
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
                            if($started_at->gte($ended_at)){
                                return $fail("End date should be greater than start date");
                            }
                            if ($ended_at > Carbon::now()) {
                                return $fail("Training time cant be in future");
                            }
                        }
                    }
                ],
                'user_duration' => 'required'
            ], [
                'training_id.required' => 'Please select a training',
                'training_mode_id.required' => 'Please select a training Mode',
                'started_at.required' => 'From Date is required',
                'ended_at.required' => 'To Date is required',
                'user_duration.required' => 'Duration is required'
            ]);
        // }
            
        $training_history = TrainingHistory::find($id);

        // $training_target = TrainingTarget::where('user_id', $training_history->user_id)
        // ->where('started_at', '<=', $training_history->started_at)
        // ->where('ended_at', '>=', $training_history->started_at)
        // ->first();
        
        
           // Approved duration is equal to user duration initially
        $training_history->approved_duration = $request->user_duration;
        
        

        $training_history->fill($request->except('user_duration'));
     
        if(auth()->user()->hasRole('admin')){

            $training_history->user()->associate($request->user_id);
        }
        if(auth()->user()->hasRole('trainer')){
            $training_history->user_duration = $request->user_duration;
            $training_history->user()->associate(auth()->user()->id);
        }
        $training_history->training_mode()->associate($request->training_mode_id);
		$training_history->training_type()->associate($request->training_type_id);
        if(auth()->user()->hasRole('trainer'))
        {
           $training_history->status()->associate(5); 
        }elseif (auth()->user()->hasRole('admin')) {
            $training_history->status()->associate($request->status_id);
        }    
        

        $training_history->save();

        if(auth()->user()->hasRole('admin')){
            if($request->status_id == 6){

                $training_target = TrainingTarget::where('active_status', 1)->where('user_id', $training_history->user_id)
                    ->where('started_at', '<=', $request->started_at)
                    ->where('ended_at', '>=', $request->ended_at)
                    ->first();
                    // dd( $training_target);

                if($training_target){

                    // $trainings_time_duration = TrainingHistory::where('user_id',$training_history->user_id)
                    // ->where('training_user_id',$training_history->training_user_id)
                    // ->where('status_id',6)
                    // ->get();
                    // $totalHr = 0;
                    // $totalMin = 0;
                    // foreach($trainings_time_duration as $key => $times)
                    // {
                    //     $time = explode(':',$times->approved_duration);
                    //     $hour = trim($time[0])*60;
                    //     $minute = trim($time[1]);
                    
                    //     $totalHr += $hour;
                    //     $totalMin += $minute;
                    //     $total_minute = $totalHr + $totalMin;
                    //     //$data[] = array_sum($total_minute);
                    // }

                    $time = explode(':', $request->user_duration);
                    $hour = trim($time[0])*60;
                    $minute = trim($time[1]);
                
                   
                    $total_minute = $hour + $minute;

                    //total minute save pending and approved           
                    $training_target->achieved_hour = $training_target->achieved_hour + $total_minute;                        
                                        
                    $training_target->save();   
                }
            }   
        }

        return ["success" => "Training history updated Successfully"];
    }

    public function delete($id)
    {
        $training_history = TrainingHistory::find($id);
        return view('training-histories.delete', ['training_history' => $training_history]);
    }
    public function destroy($id)
    {
        $user = TrainingHistory::find($id);
        $result = $user->delete();
        if($result)
        {
            $trainings_time_duration = TrainingHistory::where('user_id',$user->user_id)
            ->where('training_user_id',$user->training_user_id)
            ->whereIn('status_id',[5,6])
            ->get();
            $totalHr = 0;
            $totalMin = 0;
            foreach($trainings_time_duration as $key => $times)
            {
                $time = explode(':',$times->approved_duration);
                $hour = trim($time[0])*60;
                $minute = trim($time[1]);
            
                $totalHr += $hour;
                $totalMin += $minute;
                $total_minute = $totalHr + $totalMin;
            }
            DB::table('training_targets')
            ->where('user_id',$user->user_id)
            ->where('id',$id)
            ->update(['achieved_hour'=> $total_minute]);
        }
        return ["success" => "TrainingHistory Deleted Successfully"];
    }

    

}
