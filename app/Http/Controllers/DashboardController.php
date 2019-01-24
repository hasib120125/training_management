<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Content;
use App\TrainingTarget;
use App\TrainingUser;

class DashboardController extends Controller
{
  public function index(){
    if(auth()->user()->hasRole('admin')){
      return view('dashboard.admin');
    }
    $targets = TrainingTarget::where('active_status', 1)->where('user_id','=',auth()->user()->id)->orderBy('started_at','DESC')->get();  
    
    $targets = $targets->map(function($target) {  
      //$target->percentage = $target->achieved_hour / $target->target_hour * 100;
      //dd($target);

      $hours = ($target->achieved_hour)/60;                         
      $round_hours = (100/$target->target_hour)*$hours;
      
      $target->achieved_hours = number_format($hours, 2);
      
      $target->remain_hours = number_format($target->target_hour - $hours, 2);

      $target->achieved_percentage = number_format($round_hours, 2);

      $target->remain_percentage = 100 - $target->achieved_percentage;

      return $target;
    });
      
    $currentMonth = date('m');
    $top_achievements = TrainingTarget::where('active_status', 1)->orderBy('achieved_hour', 'DESC')->whereRaw('MONTH(started_at) = ?',[$currentMonth])
    ->get(); 
    // dd($top_achievements); 
    return view('dashboard.trainer',compact('targets','top_achievements'));
  }
}
