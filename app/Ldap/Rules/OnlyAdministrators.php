<?php

namespace App\Ldap\Rules;

use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\ActiveDirectory\Group;
class OnlyAdministrators extends Rule
{
    /**
     * Check if the rule passes validation.
     *
     * @return bool
     */
    public function isValid()
    {
            $administrators = Group::find('cn=GRPS-ACESSA-BPCF,ou=GROUPS SECURITY,dc=bopaper,dc=local');
    
            return $this->user->groups()->recursive()->exists($administrators);
        
    }
}
