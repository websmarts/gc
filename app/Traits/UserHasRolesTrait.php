<?php

namespace App\Traits;

trait UserHasRolesTrait
{

    /**
     * Check if Role is true
     */
    public function checkRole($role = false)
    {
        if (!$role)
            return false;

        $role = trim($role); // remove any pesky whitespace

        $roles = $this->getModelRoles();

        return isset($roles[$role]) ? $roles[$role] : false;
    }

    /**
     * Check if Role is true
     */
    public function hasRole($roles = false)
    {
        if (!$roles)
            return false;

        // If string provided convert roles to array
        if(is_string($roles)) {
            if(strpos($roles,',')){
                
                // explode on comma
                $roles = explode(',',$roles);
            } else {
                $roles = explode(' ',$roles);
            }
        }

        // start the search process
        $roleFound = false;
        if(is_array($roles)) {
            foreach($roles as $role){
                if( $this->checkRole($role) ) {
                    $roleFound = true;
                    break; // found one so no need to look further
                }
            }
        }

        return $roleFound;
    }



    /**
     * User and Contact models support different sets of roles
     * This method returns the roles for the model being used
     */
    private function getModelRoles()
    {
        $roles = [];

        $modelClass = get_class($this);

        if ($modelClass == "App\Models\User") {
            $roles = [
                'system-administrator' => $this->hasAttribute('is_admin') ? $this->is_admin  === 1 : false,
                'account-manager' => $this->organisations->count() > 0,
            ];
        }

        if ($modelClass == "App\Models\Contact") {
            $roles = [
                'membership-manager' => $this->memberships->where('pivot.is_primary_contact', 1)->count() > 0,
                'member' => $this->memberships->count() > 0,
                'contact' => true,
            ];
        }

        return $roles;
    }

    public function hasAttribute($attr)
    {
        return array_key_exists($attr, $this->attributes);
    }
}