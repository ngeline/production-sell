<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduksiModel;
use \Dompdf\Dompdf;

class LaporanProduksiController extends BaseController
{
    protected $ProduksiModel;
    public function __construct()
    {
        $this->ProduksiModel = new ProduksiModel();
    }

    public function index()
    {
        $filter = $this->request->getVar('datefilter');
        $toOld = $this->request->getVar('toOld');
        if ($filter) {
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            // dd('Awal =' . $start, 'akhir =' . $until);
            $produksi = $this->ProduksiModel->cariDataAntara('tgl_pro', $start, $until)->getResultArray();
        } else {
            $produksi = $this->ProduksiModel->orderBy('created_at', 'desc')->paginate(10, 'produksi');
        }


        $currentPage = $this->request->getVar('page_produksi') ? $this->request->getVar('page_produksi') : 1;

        $data = [
            'title' => 'Laporan Produksi',
            'produksi' => $produksi,
            'pager' => $this->ProduksiModel->pager,
            'currentPage' => $currentPage,
            'toOld' => $toOld,
            'datefilter' => $filter
        ];
        return view('admin/laporan/produksi/index', $data);
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
            $data = $this->ProduksiModel->cariDataAntara('tgl_pro', $start, $until)->getResultArray();
        } else {
            // dd('lah');
            $data = $this->ProduksiModel->findAll();
        }


        // create PDF
        $dompdf = new Dompdf();
        $html = view('admin/laporan/produksi/viewPrint', ['data' => $data]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        // output PDF
        $dompdf->stream('Produksi.pdf', ['Attachment' => false]);
    }
}
