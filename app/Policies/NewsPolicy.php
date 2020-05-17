<?php

namespace App\Policies;

use App\Models\News;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * User permission to edit news
     *
     * @param User $user
     * @param News $news
     * @return boolean
     */
    public function newsEdit(User $user, News $news)
    {
        return $user->id == $news->user_id;
    }

    /**
     * User permission to update news
     *
     * @param User $user
     * @param News $news
     * @return boolean
     */
    public function newsUpdate(User $user, News $news)
    {
        return $user->id == $news->user_id;
    }

    /**
     * User permission to delete news
     *
     * @param User $user
     * @param News $news
     * @return boolean
     */
    public function newsDelete(User $user, News $news)
    {
        return $user->id == $news->user_id;
    }

    /**
     * User permission to show news
     *
     * @param User $user
     * @param News $news
     * @return boolean
     */
    public function newsShow(User $user, News $news)
    {
        return $user->id == $news->user_id;
    }

    /**
     * Sometimes, you may wish to grant all abilities to a specific user.
     * You may use the before method to define a callback that is run before all
     * other authorization checks:
     *
     * If the before callback returns a non-null result that result will be
     * considered the result of the check.
     *
     * @param User $user
     * @param mixed $ability (news-edit, news-create, news-show)
     * @return boolean|null
     */
    public function before($user, $ability)
    {

    }

    /**
     * You may use the after method to define a callback to be executed after
     * all other authorization checks:
     *
     * Similar to the before check, if the after callback returns a non-null result that result
     * will be considered the result of the check.
     *
     * @param User $user
     * @param mixed $ability (news-edit, news-create, news-show)
     * @return boolean|null
     */
    public function after($user, $ability, $result, $arguments)
    {

    }
}
