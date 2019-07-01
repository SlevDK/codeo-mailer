<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\ToAlias;
use Illuminate\Auth\Access\HandlesAuthorization;

class ToAliasPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any to aliases.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the to alias.
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
     * Determine whether the user can create to aliases.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the to alias.
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
     * Determine whether the user can delete the to alias.
     *
     * @param User $user
     * @param ToAlias $toAlias
     * @return mixed
     */
    public function delete(User $user, ToAlias $toAlias)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the to alias.
     *
     * @param User $user
     * @param ToAlias $toAlias
     * @return mixed
     */
    public function restore(User $user, ToAlias $toAlias)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the to alias.
     *
     * @param User $user
     * @param ToAlias $toAlias
     * @return mixed
     */
    public function forceDelete(User $user, ToAlias $toAlias)
    {
        return false;
    }
}
