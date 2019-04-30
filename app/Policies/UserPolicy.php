<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $me, User $user): bool
    {
        // 開こうとしているユーザが$meと一致しているかどうか
        return $user->is($me);
    }

    public function showEmail(User $me, User $user): bool
    {
        return $user->is($me);
    }

    public function showLogoutButton(User $me, User $user): bool
    {
        return $user->is($me);
    }
}
