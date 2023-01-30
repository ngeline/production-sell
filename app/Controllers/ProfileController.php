<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Profile',
        ];
        return view('admin/profile/index', $data);
    }
}
