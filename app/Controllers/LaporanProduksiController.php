<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LaporanProduksiController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Laporan Produksi'
        ];
        return view('admin/laporan/produksi/index', $data);
    }
}
