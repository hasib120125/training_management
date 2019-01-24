<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use Carbon\Carbon;


class TrainingTarget extends Model
{
    use Userstamps;

    protected $dates = [
        'started_at',
        'ended_at',
    ];

    protected $fillable = ['started_at', 'ended_at', 'target_hour','user_id','active_status'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function setEndedAtAttribute($value){
        $this->attributes['ended_at'] = Carbon::parse($value)->endOfDay()->toDateTimeString();
    }
}
