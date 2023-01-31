<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PenjualanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Penjualan'
        ];
        return view('admin/penjualan/index', $data);
    }
}
