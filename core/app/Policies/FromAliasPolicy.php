<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\FromAlias;
use Illuminate\Auth\Access\HandlesAuthorization;

class FromAliasPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any from aliases.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the from alias.
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
     * Determine whether the user can create from aliases.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the from alias.
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
     * Determine whether the user can delete the from alias.
     *
     * @param User $user
     * @param FromAlias $fromAlias
     * @return mixed
     */
    public function delete(User $user, FromAlias $fromAlias)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the from alias.
     *
     * @param User $user
     * @param FromAlias $fromAlias
     * @return mixed
     */
    public function restore(User $user, FromAlias $fromAlias)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the from alias.
     *
     * @param User $user
     * @param FromAlias $fromAlias
     * @return mixed
     */
    public function forceDelete(User $user, FromAlias $fromAlias)
    {
        return false;
    }
}
