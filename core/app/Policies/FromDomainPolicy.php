<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\FromDomain;
use Illuminate\Auth\Access\HandlesAuthorization;

class FromDomainPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any from domains.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the from domain.
     *
     * @param User $user
     * @param Mail $mail
     * @return mixed
     */
    public function view(User $user, Mail $mail)
    {
        return $user->id === $mail->campaign->user_id;
    }

    /**
     * Determine whether the user can create from domains.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the from domain.
     *
     * @param User $user
     * @param Mail $mail
     * @return mixed
     */
    public function update(User $user, Mail $mail)
    {
        return $user->id === $mail->campaign->user_id;
    }

    /**
     * Determine whether the user can delete the from domain.
     *
     * @param User $user
     * @param FromDomain $fromDomain
     * @return mixed
     */
    public function delete(User $user, FromDomain $fromDomain)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the from domain.
     *
     * @param User $user
     * @param FromDomain $fromDomain
     * @return mixed
     */
    public function restore(User $user, FromDomain $fromDomain)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the from domain.
     *
     * @param User $user
     * @param FromDomain $fromDomain
     * @return mixed
     */
    public function forceDelete(User $user, FromDomain $fromDomain)
    {
        return false;
    }
}
