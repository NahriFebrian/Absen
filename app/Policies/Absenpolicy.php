<?php

namespace App\Policies;

use App\User;
use App\Absen;
use Illuminate\Auth\Access\HandlesAuthorization;

class Absenpolicy
{
    use HandlesAuthorization;

    public function update(User $user,Absen $absen)
    {
        return $user->ownsAbsen($absen);
    }

    public function delete(User $user,Absen $absen)
    {
        return $user->ownsAbsen($absen);
    }
}
