<?php

namespace App;

use App\Models\Role;
use App\Helpers\ConvertHelper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'timezone'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get the user name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ConvertHelper::title($value);
    }

    /**
     * Get the user email.
     *
     * @param  string  $value
     * @return string
     */
    public function getEmailAttribute($value)
    {
        return ConvertHelper::lower($value);
    }

    /**
     * Get the user created.
     *
     * @param  DateTime  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
       return ConvertHelper::datetime($value, auth()->user()->timezone);
    }

    /**
     * Get the user updated.
     *
     * @param  DateTime  $value
     * @return string
     */
    public function getUpdatedAtAttribute($value)
    {
       return ConvertHelper::datetime($value, auth()->user()->timezone);
    }

    /**
     * Get the news created.
     *
     * @param  DateTime  $value
     * @return string
     */
    public function getEmailVerifiedAtAttribute($value)
    {
       return !empty($value) ? ConvertHelper::datetime($value, auth()->user()->timezone) : '';
    }

    /**
     * The user that belong to many role.
     */
    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }


    /**
     * Verify if user have permission access on system
     *
     * @param App\Models\Permission $permission
     * @return boolean
     */
    public function hasPermission($permission)
    {
        return $this->hasAnyRoles($permission->role);
    }


    /**
     * Verify if user have role access on system
     *
     * @param App\Models\Role $role
     * @return boolean
     */
    public function hasAnyRoles($role)
    {
        /*foreach ($role as $key) {
            return $this->role->contains('name', $key->name);
        }*/
        if(is_object($role) || is_array($role)){
            return (boolean) $role->intersect($this->role)->count();
        }else{
            return $this->role->contains('name', $role);
        }
    }

    /**
     * If user is Root
     *
     * @return boolean|null
     */
    public function isRoot()
    {
        return $this->hasAnyRoles('root') ? true : null;
    }
}
