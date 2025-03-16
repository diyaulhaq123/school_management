<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RoleCheckTrait
{
    public function authorizeRoles(array $roles)
    {
        $user = auth()->user()->roles;

        if (!$user || !in_array($user, $roles)) {
            return redirect()->back()->with('error', 'Unauthorised access!');
        }
    }
}
