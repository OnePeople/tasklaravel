<?php

namespace App\Repositories;

use App\Models\User;

/**
 * User Repository.
 */
class UserRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model():string
    {
        return User::class;
    }
}
