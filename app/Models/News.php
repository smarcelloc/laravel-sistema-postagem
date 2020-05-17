<?php

namespace App\Models;

use App\User;
use App\Helpers\ConvertHelper;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title','description','user_id'
    ];


    /**
     * Get the news title.
     *
     * @param  string  $value
     * @return string
     */
    public function getTitleAttribute($value)
    {
        return ConvertHelper::title($value);
    }


    /**
     * Get the news created.
     *
     * @param  DateTime  $value
     * @return string
     */
    public function getCreatedAtAttribute($value)
    {
       return ConvertHelper::datetime($value, auth()->user()->timezone);
    }


    /**
     * The users that belong to the news.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
