<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\Http\JsonResponseTrait;

class ApiBaseController extends Controller
{
    use JsonResponseTrait;
}