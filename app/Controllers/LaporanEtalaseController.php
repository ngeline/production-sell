<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtalaseModel;
use App\Models\ProduksiModel;
use Dompdf\Dompdf;

class LaporanEtalaseController extends BaseController
{
    protected $etalaseModel;
    protected $produksiModel;
    public function __construct()
    {
        $this->etalaseModel = new EtalaseModel();
        $this->produksiModel = new ProduksiModel();
    }

    public function index()
    {
        $filter = $this->request->getVar('datefilter');
        $toOld = $this->request->getVar('toOld');
        if ($filter) {
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            $etalase = $this->etalaseModel->cariDataAntara('tgl_et', $start, $until)->getResultArray();
        } else {
            $etalase = $this->etalaseModel->orderBy('created_at', 'desc')->paginate(5, 'etalase');
        }
        $currentPage = $this->request->getVar('page_etalase') ? $this->request->getVar('page_etalase') : 1;
        $data = [
            'title' => 'Laporan Etalase',
            'etalase' => $etalase,
            'pager' => $this->etalaseModel->pager,
            'currentPage' => $currentPage,
            'toOld' => $toOld,
            'datefilter' => $filter,
        ];
        return view('admin/laporan/etalase/index', $data);
    }

    public function print()
    {
        $filter = $this->request->getVar('rangeDate');
        if ($filter) {
            // dd('disini');
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            // dd('Awal =' . $start, 'akhir =' . $until);
            $data = $this->etalaseModel->cariDataAntara('tgl_et', $start, $until)->getResultArray();
        } else {
            // dd('lah');
            $data = $this->etalaseModel->orderBy('created_at', 'desc')->paginate(5, 'etalase');
        }
        // return view('admin/laporan/etalase/viewPrint', ['data' => $data]);


        // create PDF
        $dompdf = new Dompdf();
        $html = view('admin/laporan/etalase/viewPrint', ['data' => $data]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        // output PDF
        $dompdf->stream('Etalase.pdf', ['Attachment' => false]);
    }
}
