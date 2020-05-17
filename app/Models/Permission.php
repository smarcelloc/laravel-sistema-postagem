<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ConvertHelper;

class Permission extends Model
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
     * Get the permission label.
     *
     * @param  string  $value
     * @return string
     */
    public function getLabelAttribute($value)
    {
        return ConvertHelper::title($value);
    }


    /**
     * Get the permission name.
     *
     * @param  string  $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return ConvertHelper::lower($value);
    }

    /**
     * The permission that belong to many role.
     */
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_permissions');
    }
}
