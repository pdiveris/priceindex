<?php

namespace App\Policies;

use App\Models\Price;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {

    }

    public function view(User $user, Price $price): bool
    {
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Price $price): bool
    {
    }

    public function delete(User $user, Price $price): bool
    {
    }

    public function restore(User $user, Price $price): bool
    {
    }

    public function forceDelete(User $user, Price $price): bool
    {
    }
}
