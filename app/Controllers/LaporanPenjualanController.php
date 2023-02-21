<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenjualanModel;
use Dompdf\Dompdf;

class LaporanPenjualanController extends BaseController
{
    protected $penjualanModel;
    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
    }

    public function index()
    {
        $filter = $this->request->getVar('datefilter');
        $toOld = $this->request->getVar('toOld');
        if ($filter) {
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            // dd('Awal =' . $start, 'akhir =' . $until);
            $penjualan = $this->penjualanModel->cariDataAntara('tgl_inp', $start, $until)->getResultArray();
        } else {
            $penjualan = $this->penjualanModel->orderBy('created_at', 'desc')->paginate(10, 'penjualan');
        }


        $currentPage = $this->request->getVar('page_penjualan') ? $this->request->getVar('page_penjualan') : 1;

        $data = [
            'title' => 'Laporan Penjualan',
            'penjualan' => $penjualan,
            'pager' => $this->penjualanModel->pager,
            'currentPage' => $currentPage,
            'toOld' => $toOld,
            'datefilter' => $filter
        ];
        return view('admin/laporan/penjualan/index', $data);
    }

    public function print()
    {
        // dd($this->request->getVar());

        // get data from model
        $filter = $this->request->getVar('rangeDate');
        if ($filter) {
            // dd('disini');
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            // dd('Awal =' . $start, 'akhir =' . $until);
            $data = $this->penjualanModel->cariDataAntara('tgl_inp', $start, $until)->getResultArray();
        } else {
            // dd('lah');
            $data = $this->penjualanModel->findAll();
        }


        // create PDF
        $dompdf = new Dompdf();
        $html = view('admin/laporan/penjualan/viewPrint', ['data' => $data]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        // output PDF
        $dompdf->stream('Penjualan.pdf', ['Attachment' => false]);
    }
}
