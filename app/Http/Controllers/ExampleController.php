<?php

namespace App\Http\Controllers;

use App\Services\ExampleService;

class ExampleController extends Controller
{

    private $exampleService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    public function index()
    {
        return  $this->exampleService->index();
    }
}
