<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OpnameModel;
use Dompdf\Dompdf;

class LaporanOpnameController extends BaseController
{
    protected $opnameModel;
    public function __construct()
    {
        $this->opnameModel = new OpnameModel();
    }

    public function index()
    {
        $filter = $this->request->getVar('datefilter');
        $toOld = $this->request->getVar('toOld');
        if ($filter) {
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            $opname = $this->opnameModel->cariDataAntara('tgl_opn', $start, $until)->getResultArray();
        } else {
            $opname = $this->opnameModel->orderBy('created_at', 'desc')->paginate(5, 'opname');
        }
        $currentPage = $this->request->getVar('page_opname') ? $this->request->getVar('page_opname') : 1;
        $data = [
            'title' => 'Laporan Opname',
            'opname' => $opname,
            'pager' => $this->opnameModel->pager,
            'currentPage' => $currentPage,
            'toOld' => $toOld,
            'datefilter' => $filter,
        ];
        return view('admin/laporan/opname/index', $data);
    }

    public function print()
    {
        $filter = $this->request->getVar('rangeDate');
        if ($filter) {
            // dd('disini');
            $start = substr($filter, 0, 10);
            $until = substr($filter, 13, 10);
            // dd('Awal =' . $start, 'akhir =' . $until);
            $data = $this->opnameModel->cariDataAntara('tgl_opn', $start, $until)->getResultArray();
        } else {
            // dd('lah');
            $data = $this->opnameModel->orderBy('created_at', 'desc')->paginate(5, 'opname');
        }


        // create PDF
        $dompdf = new Dompdf();
        $html = view('admin/laporan/opname/viewPrint', ['data' => $data]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        // output PDF
        $dompdf->stream('opname.pdf', ['Attachment' => false]);
    }
}
