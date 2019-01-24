<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrainingHistory;
use App\TrainingTarget;
use App\User;
use App\Training;
use Yajra\Datatables\Datatables;

class ReportController extends Controller
{
    public function topicWiseReprot()
    {
        $company_id = auth()->user()->company->id;
        $users = User::whereHas('roles', function($query){
            $query->where('name', '=', 'trainer');
        })
        ->where('company_id', $company_id)
        ->where('is_active', true)
        ->pluck('name', 'id');
        $trainings = Training::pluck('title','id'); 
        return view('reports.topic-wise-reprot',compact('users','trainings'));
    }

    public function topicWiseReprotData(Datatables $datatables)
    {
        $query = TrainingHistory::with('training')
        ->with('audience')
        ->with('user')
        ->with('training_type')
        ->with('training_mode')
        ->with('training_system')
        ->with('training_brand')
        ->with('status')
        ->select('training_histories.*');

        if(auth()->user()->hasRole('trainer')){
            $query = $query->where('user_id', auth()->user()->id);
        }
        $request  = $datatables->getRequest();

        if($request){
          $query = $query->whereBetween('training_histories.updated_at', [$request->start_date, $request->end_date]);
        }

        if($request->training_id){
          $query = $query->where('training_id',$request->training_id);
        }

        if ($request->user_id) {
            $query = $query->where('user_id', $request->user_id);
        }
      // $query = $query->get();
      //  dd($query);
       
        $datatables = $datatables->eloquent($query)
          ->addColumn('user', function ($training_history) {
            if($training_history->user)
            {
                return $training_history->user->name;
            }  
            return '';
          })

          ->addColumn('training', function ($training_history) {
            if($training_history->training)
            {
                return $training_history->training->title;
            }  
            return '';
          })

          ->addColumn('status', function ($training_history) {
              return $training_history->status->name  ?? "";
          })
          ->addColumn('audience', function ($training_history) {
            if($training_history->audience)
            {
              return $training_history->audience->name ?? "";  
            }
            return '';                 
          })
          ->addColumn('training_type',function($training_history)
          {
            return $training_history->training_type->name ?? "";
          })

          ->addColumn('training_mode',function($training_history)
          {
            return $training_history->training_mode->name ?? "";
          })
          ->addColumn('training_system',function($training_history)
          {
            return $training_history->training_system->name ?? "";
          })
          ->addColumn('training_brand',function($training_history)
          {
            return $training_history->training_brand->name ?? "";
          });
          
        return $datatables->make(true);
    }

    public function targetAchievementWiseReport()
    {
      $company_id = auth()->user()->company->id;
      $users = User::whereHas('roles', function($query){
        $query->where('name', '=', 'trainer');
      })
      ->where('company_id', $company_id)
      ->where('is_active', true)
      ->pluck('name', 'id');
      return view('reports.target-achievement-reprot',compact('users'));
    }

    public function  targetAchievementWiseReportData(Datatables $datatables)
    {
        $query = TrainingTarget::with('user')->select('training_targets.*');

        $request  = $datatables->getRequest();
        if($request){
          $query = $query->whereBetween('training_targets.updated_at', [$request->start_date, $request->end_date]);
        }

        if ($request->user_id) {
          $query = $query->where('user_id', $request->user_id);
        }

        return $datatables->eloquent($query)
        ->addColumn('user_name', function ($training_target) {
              return $training_target->user->name;
        })

        ->addColumn('achieved_hours', function ($training_target) {
            if($training_target->achieved_hour){
                $hour = floor($training_target->achieved_hour / 60);
                $minute = ($training_target->achieved_hour % 60);
                return $hour.':'.$minute;
                } 
                return '0:0';
        })
          
        ->addColumn('remaining', function ($training_target) {
            $return_string = '';
            $total_minute = ($training_target->target_hour * 60) - $training_target->achieved_hour;
            if ($total_minute < 0) {
              $return_string .= '-';
              $total_minute = abs($total_minute);
            }
            $hours = floor($total_minute / 60);
            $minute = ($total_minute % 60);
            
            $return_string .= $hours . ':' . $minute;

            return $return_string;
        })          
        ->make(true);
    }
}
