<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\FromLogin;
use Illuminate\Auth\Access\HandlesAuthorization;

class FromLoginPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any from logins.
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
     * Determine whether the user can create from logins.
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
     * Determine whether the user can delete the from login.
     *
     * @param User $user
     * @param FromLogin $fromLogin
     * @return mixed
     */
    public function delete(User $user, FromLogin $fromLogin)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the from login.
     *
     * @param User $user
     * @param FromLogin $fromLogin
     * @return mixed
     */
    public function restore(User $user, FromLogin $fromLogin)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the from login.
     *
     * @param User $user
     * @param FromLogin $fromLogin
     * @return mixed
     */
    public function forceDelete(User $user, FromLogin $fromLogin)
    {
        return false;
    }
}
