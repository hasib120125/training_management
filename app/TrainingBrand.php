<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class TrainingBrand extends Model
{
    use Userstamps;
    protected $fillable = ['name','active_status'];
}
