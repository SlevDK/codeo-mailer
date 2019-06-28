<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\Header;
use Illuminate\Auth\Access\HandlesAuthorization;

class HeaderPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any headers.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the header.
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
     * Determine whether the user can create headers.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the header.
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
     * Determine whether the user can delete the header.
     *
     * @param User $user
     * @param Header $header
     * @return mixed
     */
    public function delete(User $user, Header $header)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the header.
     *
     * @param User $user
     * @param Header $header
     * @return mixed
     */
    public function restore(User $user, Header $header)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the header.
     *
     * @param User $user
     * @param Header $header
     * @return mixed
     */
    public function forceDelete(User $user, Header $header)
    {
        return false;
    }
}
