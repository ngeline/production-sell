<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        // $user = new UserModel();
        // $u = $user->userRole()->find(user()->id)->nameRole;
        // dd($u);
        $data = [
            'title' => 'Dashboard',
        ];
        return view('admin/dashboard', $data);
    }
}
