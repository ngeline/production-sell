<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProduksiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Data Produksi',
        ];
        return view('admin/produksi/index', $data);
    }
    public function detail()
    {
        $data = [
            'title' => 'Detail Produksi',
        ];
        return view('admin/produksi/detail', $data);
    }
}
