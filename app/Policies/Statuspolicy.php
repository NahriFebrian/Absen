<?php

namespace App\Policies;

use App\User;
use App\Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class Statuspolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function update(User $user,Status $status)
    {
        return $user->ownsStatus($status);
    }

    public function delete(User $user,Status $status)
    {
        return $user->ownsStatus($status);
    }
}
