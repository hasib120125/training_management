<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;

use Wildside\Userstamps\Userstamps;

class TrainingFile extends Model
{
    use LogsActivity;
    use Userstamps;
    protected static $logName = 'training-files';
    protected static $logFillable = true;
    protected $fillable = [
      'name',
      'raw_name',
      'path',
      'extension',
      'mime_type',
      'size',
      'training_id',
      'is_active',
      'created_at',
      'updated_at'
    ];
    public function training(){
        return $this->belongsTo('App\Training');
    }

    
}
