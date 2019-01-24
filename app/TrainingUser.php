<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class TrainingUser extends Model
{
    use LogsActivity;
    use Userstamps;
    protected static $logName = 'training-user';
    protected static $logFillable = true;
    protected $table='training_user';
    protected $fillable = [
      'started_at',
      'ended_at',
      'completed_at',
      'active_status'
    ];
    protected $dates = [
      'started_at',
      'ended_at',
      'completed_at',
    ];


    public function files()
    {
        return $this->hasMany('App\TrainingFile');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function training(){
        return $this->belongsTo('App\Training');
    }
    public function status(){
        return $this->belongsTo('App\Status');
    }
}
