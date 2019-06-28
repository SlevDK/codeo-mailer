<?php

namespace App\Policies;

use App\Models\Mail;
use App\Models\User;
use App\Models\Topic;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any topics.
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
     * @param Topic $topic
     * @return mixed
     */
    public function view(User $user, Mail $mail)
    {
        return $user->id === $mail->campaign->user_id;
    }

    /**
     * Determine whether the user can create topics.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the topic.
     *
     * @param User $user
     * @param Topic $topic
     * @return mixed
     */
    public function update(User $user, Mail $mail)
    {
        return $user->id === $mail->campaign->user_id;
    }

    /**
     * Determine whether the user can delete the topic.
     *
     * @param User $user
     * @param Topic $topic
     * @return mixed
     */
    public function delete(User $user, Topic $topic)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the topic.
     *
     * @param User $user
     * @param Topic $topic
     * @return mixed
     */
    public function restore(User $user, Topic $topic)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the topic.
     *
     * @param User $user
     * @param Topic $topic
     * @return mixed
     */
    public function forceDelete(User $user, Topic $topic)
    {
        return false;
    }
}
