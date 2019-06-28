<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\Body;
use Illuminate\Auth\Access\HandlesAuthorization;

class BodyPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any bodies.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the body.
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
     * Determine whether the user can create bodies.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the body.
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
     * Determine whether the user can delete the body.
     *
     * @param User $user
     * @param Body $body
     * @return mixed
     */
    public function delete(User $user, Body $body)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the body.
     *
     * @param User $user
     * @param Body $body
     * @return mixed
     */
    public function restore(User $user, Body $body)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the body.
     *
     * @param User $user
     * @param Body $body
     * @return mixed
     */
    public function forceDelete(User $user, Body $body)
    {
        return false;
    }
}
