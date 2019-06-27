<?php

namespace App\Policies;

use App\Models\Campaign;
use App\Models\User;
use App\Models\Mail;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class MailPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any mails.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the mail.
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
     * Determine whether the user can create mails.
     *
     * @param User $user
     * @param Campaign $campaign
     * @return mixed
     */
    public function create(User $user, Campaign $campaign)
    {
        return $user->id === $campaign->user_id;
    }

    /**
     * Determine whether the user can update the mail.
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
     * Determine whether the user can delete the mail.
     *
     * @param User $user
     * @param Mail $mail
     * @return mixed
     */
    public function delete(User $user, Mail $mail)
    {
        return $user->id === $mail->campaign->user_id;
    }

    /**
     * Determine whether the user can restore the mail.
     *
     * @param User $user
     * @param Mail $mail
     * @return mixed
     */
    public function restore(User $user, Mail $mail)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the mail.
     *
     * @param User $user
     * @param Mail $mail
     * @return mixed
     */
    public function forceDelete(User $user, Mail $mail)
    {
        return $user->id === $mail->campaign->user_id;
    }
}
