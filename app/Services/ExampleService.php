<?php

namespace App\Services;

use App\Repositories\ExampleRepository;
use App\Traits\CrudTrait;

class ExampleService
{
    use CrudTrait;

    private $exampleRepository;

    public function __construct(ExampleRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
        $this->setActionRepository($this->exampleRepository);
    }
    
    public function index()
    {
        return $this->findAll();
    }
}