<?php

namespace App\Policies\Database;

use App\Models\User;
use App\Models\Database\Maillist;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaillistPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any maillists.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the topic.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function view(User $user, Maillist $maillist)
    {
        return $user->id === $maillist->user_id;
    }

    /**
     * Determine whether the user can create topics.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the topic.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function update(User $user, Maillist $maillist)
    {
        return $user->id === $maillist->user_id;
    }

    /**
     * Determine whether the user can delete the topic.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function delete(User $user, Maillist $maillist)
    {
        return $user->id === $maillist->user_id;
    }

    /**
     * Determine whether the user can restore the topic.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function restore(User $user, Maillist $maillist)
    {
        return $user->id === $maillist->user_id;
    }

    /**
     * Determine whether the user can permanently delete the topic.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function forceDelete(User $user, Maillist $maillist)
    {
        return $user->id === $maillist->user_id;
    }
}
