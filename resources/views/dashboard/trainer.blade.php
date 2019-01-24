@extends('layouts/dashboard')
@section('page-title', 'Dashboard')
@section('content')
<div class="container-fluid">
  <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="header">
          <div class="row">
            <div class="col-md-6">
              <h2 class="darkblue-color">Trainer Dashboard</h2><br>
              {{ auth()->user()->name }}
            </div>
            
            <div class="col-md-6">
              <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="darkblue-color">Name</th>
                      {{-- <th>User Name</th> --}}
                      <th class="darkblue-color">Achieved Hours</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($top_achievements as $target)
                    <tr>
                      <td>{{$target->user->name}}</td>
                      {{-- <td>{{$target->user->username}}</td> --}}
                      <td>
                        <?php
                          $hours = ($target->achieved_hour)/60;
                          
                          $round_hours = round($hours, 2)*100;
                          $perce_ntage = $round_hours / $target->target_hour; 
                          echo $percentage = number_format($perce_ntage, 2).' %';
                          
                        ?>
					            </td>
                    </tr>
                    @endforeach                    
                  </tbody>
                </table>
            </div>

          </div>
          
        </div>
        <div class="body">
          <div class="row">
            <div class="col-md-12">            
              @foreach($targets as $target)
              <div>
                <strong class="darkblue-color">Period : </strong>{{$target->started_at->format('Y-m-d') .' / '.$target->ended_at->format('Y-m-d') }}                  
              </div>
              <div class="row">
              <div class="col-md-10">
              <div class="progress">
          
                <div id="achieved" class="progress-bar progress-bar-striped progress-bar-success active" data-toggle="tooltip" data-placement="top" title="{{$target->achieved_hours}} hrs" role="progressbar" style="width:{{$target->achieved_percentage}}%">
                   
                    {{$target->achieved_percentage}}%
                  
                </div>

                <div id="remaining" class="progress-bar progress-bar-striped progress-bar-danger" data-toggle="tooltip" data-placement="top" title="{{$target->remain_hours}} hrs" style="width:{{$target->remain_percentage}}%">                       
                    {{$target->remain_percentage}}%                                    
                </div>                      
              </div>
            </div>
            <div class="col-md-2">
              <span><strong class="darkblue-color">{{$target->target_hour}}</strong> Hours</span>
            </div>
          </div>

             @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
