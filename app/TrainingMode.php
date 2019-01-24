<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TrainingMode extends Model
{
    use Userstamps;
    protected $fillable = ['id', 'name','active_status'];
}
