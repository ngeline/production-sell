<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LaporanPenjualanController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Penjualan'
        ];
        return view('admin/laporan/penjualan/index', $data);
    }
}
