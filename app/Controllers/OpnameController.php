<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OpnameController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Opname'
        ];
        return view('admin/opname/index', $data);
    }
}
