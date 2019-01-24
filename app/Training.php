<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Wildside\Userstamps\Userstamps;

class Training extends Model
{
    use LogsActivity;
    use Userstamps;
    protected static $logName = 'training';
    protected static $logFillable = true;
    protected $fillable = [
        'id',
        'title',
        'description',
        'started_at',
        'training_type_id',
        'training_mode_id',
        'ended_at',
        'training_system',
        'training_brand',
        'status_id',
        'company_id',
        'created_at',
        'updated_at',
        'active_status'
    ];
    protected $dates = [
        'started_at',
        'ended_at',
        'created_at',
        'updated_at'
    ];

    public function files()
    {
        return $this->hasMany('App\TrainingFile');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function type(){
        return $this->belongsTo('App\TrainingType', 'training_type_id');
    }
    public function mode(){
        return $this->belongsTo('App\TrainingMode', 'training_mode_id');
    }
    public function training_users(){
        return $this->hasMany('App\TrainingUser');
    }
}
