<?php

namespace App\Models;

use App\Helpers\ConvertHelper;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label'
    ];


    /**
     * Get the roles label.
     *
     * @param  string  $value
     * @return string
     */
    public function getLabelAttribute($value)
    {
        return ConvertHelper::title($value);
    }


    /**
     * Get the roles name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ConvertHelper::lower($value);
    }


    /**
     * The role that belong to many permission.
     */
    public function permission()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions');
    }

    /**
     * The user that belong to many role.
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
