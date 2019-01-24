<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TrainingSystem extends Model
{
    use Userstamps;
    protected $fillable = ['name','active_status'];
}
