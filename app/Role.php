<?php

namespace App;

use Spatie\Permission\Models\Role as RootRole;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends RootRole
{
    use LogsActivity;
    protected static $logName = 'roles';
    protected static $logFillable = true;
    protected $fillable = ['id', 'name', 'guard_name', 'display_name', 'company_id'];
    public function categories(){
      return $this->belongsToMany('App\Category');
    }
    public function getQtyAttribute(){
      return \DB::table('role_user')
      ->where('role_id', '=', $this->id)
      ->count();
    }
}
