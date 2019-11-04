<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function superAdmin(Admin $currentAdmin, Admin $admin)
    {
        return $admin->can('manage_admins');
    }
}
