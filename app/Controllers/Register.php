<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class Register extends BaseController
{
    public function index()
    {
        return view('register');

    }

    // protected function secret()
    // {
    //     return view('workout');
    // }
}
