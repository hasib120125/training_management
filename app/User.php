<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;
use Wildside\Userstamps\Userstamps;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use HasRoles;
    use Userstamps;
    use Notifiable;
    use LogsActivity;
    protected static $logName = 'users';
    protected static $logFillable = true;
    protected static $ignoreChangedAttributes = ['remember_token'];
    protected $dates = ['registered_at'];
    protected $guard_name = 'admin';
    protected $fillable = [
      'id',
      'name',
      'email',
      'username',
      'password',
	  'mobile',
      'address',
      'id_number',
      'secondary_contact',
      'company_id',
      'is_default_password',
      'is_active',
      'is_locked',
      'created_at'
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
    public function trainings()
    {
        return $this->belongsToMany('App\Training');
    }

    public function passwordHistories()
    {
        return $this->hasMany('App\PasswordHistory');
    }
}
