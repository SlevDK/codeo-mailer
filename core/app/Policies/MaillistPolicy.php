<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use App\Models\Maillist;
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
     * Determine whether the user can view the maillist.
     *
     * @param User $user
     * @param Campaign $campaign
     * @return mixed
     */
    public function view(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can create maillists.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the maillist.
     *
     * @param User $user
     * @param Campaign $campaign
     * @return mixed
     */
    public function update(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can delete the maillist.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function delete(User $user, Maillist $maillist)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the maillist.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function restore(User $user, Maillist $maillist)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the maillist.
     *
     * @param User $user
     * @param Maillist $maillist
     * @return mixed
     */
    public function forceDelete(User $user, Maillist $maillist)
    {
        return false;
    }
}
