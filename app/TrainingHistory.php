<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TrainingHistory extends Model
{
    use Userstamps;
    protected $fillable = [
        'sub_title',
        'no_of_trainees',
        'user_duration',
        'approved_duration',
		'training_type_id',
        'training_system_id',
        'training_brand_id',
        'started_at',
        'ended_at',
        'location',
        'training_audience_id',
        'description'
    ];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function training(){
        return $this->belongsTo('App\Training');
    }
    public function status(){
        return $this->belongsTo('App\Status');		
    }
	public function training_type(){
        return $this->belongsTo('App\TrainingType');
    }
    public function training_mode(){
        return $this->belongsTo('App\TrainingMode');
    }
    public function training_system(){
        return $this->belongsTo('App\TrainingSystem','training_system_id');
    }
    public function training_brand(){
        return $this->belongsTo('App\TrainingBrand','training_brand_id');
    }
    public function training_user(){
        return $this->belongsTo('App\TrainingUser');
    }

    public function audience(){
        return $this->belongsTo('App\TrainingAudience','training_audience_id');
    }


}
