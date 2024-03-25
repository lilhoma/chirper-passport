<?php

namespace App\Policies;

use App\Models\Chirp;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChirpPolicy
{
   
   public function update(User $user, Chirp $chirp): bool
   {
        return $chirp -> user()->is($user);
   }
   
    public function delete(User $user, Chirp $chirp): bool
    {
        return $this -> update($user, $chirp);
    }
}
