<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\User;
use Illuminate\Http\Request;

use App\Func\Func;
use Illuminate\Support\Facades\Validator;

class LogController extends BaseController
{
    public function log(Request $request)
    {

        $a = "
        <h4> Version 0.1.0 </h4>
        <p>First release</p>

             
        ";

        return $a;
    }
}
