<?php

namespace App\Traits;

trait FunctionsTrait
{

    private function getUserRoles()
    {
        return auth()->user()->roles;
    }
    private function getUserId()
    {
        return auth()->user()->id;
    }

    public function hasRoles(string $string): bool
    {
        $routeRoles = explode('|', $string);

        $routeRoles[] = 'admin'; // Always allow admin

        $userRoles = $this->getUserRoles();

        $foundRoles = \array_intersect($userRoles, $routeRoles);

        return \count($foundRoles) > 0;
    }

    public function ownResource($resource_id): bool
    {
        $user_id = $this->getUserId();

        $is_admin = \in_array('admin', $this->getUserRoles());

        return $resource_id === $user_id || $is_admin;
    }
}
