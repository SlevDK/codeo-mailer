<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\MailSettings;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailSettingsPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any mail settings.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the mail settings.
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
     * Determine whether the user can create mail settings.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the mail settings.
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
     * Determine whether the user can delete the mail settings.
     *
     * @param User $user
     * @param MailSettings $mailSettings
     * @return mixed
     */
    public function delete(User $user, MailSettings $mailSettings)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the mail settings.
     *
     * @param User $user
     * @param MailSettings $mailSettings
     * @return mixed
     */
    public function restore(User $user, MailSettings $mailSettings)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the mail settings.
     *
     * @param User $user
     * @param MailSettings $mailSettings
     * @return mixed
     */
    public function forceDelete(User $user, MailSettings $mailSettings)
    {
        return false;
    }
}
