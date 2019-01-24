<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'display_name', 'display_order', 'whose'];
    public $timestamps = false;
}
