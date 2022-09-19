<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\services\Product\Post\PostService;

class BaseController extends Controller
{
    public $service;
    public function __construct(PostService $service)
    {
        $this->service = $service;
    }
}
