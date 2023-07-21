<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduksiModel;
use Dompdf\Dompdf;

class LaporanSablonController extends BaseController
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
            $produksi = $this->ProduksiModel->cariDataAntaraKhusus('tgl_pro', $start, $until, 'status', 'Sablon')->getResultArray();
            // dd($produksi);
        } else {
            $produksi = $this->ProduksiModel->where('status', 'Sablon')->orderBy('created_at', 'desc')->paginate(10, 'produksi');
        }
        $currentPage = $this->request->getVar('page_produksi') ? $this->request->getVar('page_produksi') : 1;
        $data = [
            'title' => 'Laporan Sablon',
            'produksi' => $produksi,
            'pager' => $this->ProduksiModel->pager,
            'toOld' => $toOld,
            'datefilter' => $filter,
            'currentPage' => $currentPage,
        ];
        return view('admin/laporan/sablon/index', $data);
    }

    public function print()
    {
        // get data from model
        $filter = $this->request->getVar('rangeDate');
        if ($filter) {
            // dd('disini');
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            // dd('Awal =' . $start, 'akhir =' . $until);
            $data = $this->ProduksiModel->cariDataAntaraKhusus('tgl_pro', $start, $until, 'status', 'Sablon')->getResultArray();
        } else {
            // dd('lah');
            $data = $this->ProduksiModel->where('status', 'Sablon')->findAll();
        }


        // create PDF
        $dompdf = new Dompdf();
        $html = view('admin/laporan/sablon/viewPrint', ['data' => $data]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        // output PDF
        $dompdf->stream('Sablon.pdf', ['Attachment' => false]);
    }
}
