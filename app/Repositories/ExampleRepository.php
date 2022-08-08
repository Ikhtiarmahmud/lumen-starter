<?php

namespace App\Repositories;

use App\Models\User;

class ExampleRepository extends AbstractBaseRepository 
{
    protected $modelName = User::class;
}