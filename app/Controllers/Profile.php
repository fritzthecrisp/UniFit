<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    public function index()
    {
        return view('profile');
    }

    // protected function secret()
    // {
    //     return view('workout');
    // }
}
