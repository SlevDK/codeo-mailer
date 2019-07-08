<?php

namespace App\Policies\Database;

use App\Models\Database\Proxy;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProxyPolicy
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
     * Determine whether the user can view the topic.
     *
     * @param User $user
     * @param Proxy $proxy
     * @return mixed
     */
    public function view(User $user, Proxy $proxy)
    {
        return $user->id === $proxy->user_id;
    }

    /**
     * Determine whether the user can create topics.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the topic.
     *
     * @param User $user
     * @param Proxy $proxy
     * @return mixed
     */
    public function update(User $user, Proxy $proxy)
    {
        return $user->id === $proxy->user_id;
    }

    /**
     * Determine whether the user can delete the topic.
     *
     * @param User $user
     * @param Proxy $proxy
     * @return mixed
     */
    public function delete(User $user, Proxy $proxy)
    {
        return $user->id === $proxy->user_id;
    }

    /**
     * Determine whether the user can restore the topic.
     *
     * @param User $user
     * @param Proxy $proxy
     * @return mixed
     */
    public function restore(User $user, Proxy $proxy)
    {
        return $user->id === $proxy->user_id;
    }

    /**
     * Determine whether the user can permanently delete the topic.
     *
     * @param User $user
     * @param Proxy $proxy
     * @return mixed
     */
    public function forceDelete(User $user, Proxy $proxy)
    {
        return $user->id === $proxy->user_id;
    }
}
