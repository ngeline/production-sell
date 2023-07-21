<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtalaseModel;
use App\Models\OpnameModel;
use App\Models\PenjualanModel;
use App\Models\ProduksiModel;

class DashboardController extends BaseController
{
    protected $etalaseModel;
    protected $produksiModel;
    protected $opnameModel;
    protected $penjualanModel;
    public function __construct()
    {
        $this->etalaseModel = new EtalaseModel();
        $this->produksiModel = new ProduksiModel();
        $this->opnameModel = new OpnameModel();
        $this->penjualanModel = new PenjualanModel();
    }
    public function index()
    {
        $filter = $this->request->getVar('tahun');
        $nProduksi = $this->produksiModel->select('sum(jmlh_brg) as total')->findAll();
        $nEtalase = $this->etalaseModel->select('sum(jmlh_et) as total')->findAll();
        $nOpname = $this->opnameModel->select('sum(jmlh_opn) as total')->findAll();
        if (empty($nOpname[0]['total'])) {
            $nOpname[0]['total'] = 0;
        }
        $totalPenjualan = $this->penjualanModel->select('sum(total_penj) as total')->findAll();

        $db = \config\Database::connect();
        if ($filter) {
            $chartPenjualan = $db->table('penjualan pen')
                ->select('pro.bahan,sum(pen.banyak_brg) as banyak,MONTH(pen.tgl_inp) as bulan')->join('produksi pro', 'pen.id_pro=pro.id_pro')->where('YEAR(tgl_inp)', $filter)->groupBy(['bahan'])->get();
        } else {
            $chartPenjualan = $db->table('penjualan pen')
                ->select('pro.bahan,sum(pen.banyak_brg) as banyak,MONTH(pen.tgl_inp) as bulan')->join('produksi pro', 'pen.id_pro=pro.id_pro')->groupBy(['bahan'])->get();
        }

        $bul = [
            'Cotton Combed 20s' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'Cotton Combed 24s' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            'Cotton Combed 30s' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
        ];
        foreach ($chartPenjualan->getResultArray() as $cp) {
            if ($cp['bahan'] == 'Cotton Combed 20s') {
                $bul['Cotton Combed 20s'][$cp['bulan'] - 1] = $cp['banyak'];
            } elseif ($cp['bahan'] == 'Cotton Combed 24s') {
                $bul['Cotton Combed 24s'][$cp['bulan'] - 1] = $cp['banyak'];
            } else {
                $bul['Cotton Combed 30s'][$cp['bulan'] - 1] = $cp['banyak'];
            }
        }

        $chartPendapatan = $db->table('penjualan')
            ->select('sum(total_penj) as pendapatan,MONTH(tgl_inp) as bulan')->groupBy(['bulan'])->where('YEAR(tgl_inp)', date('Y'))->get();
        // dd($chartPendapatan->getResultArray());

        $pendapatanPerBulan = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($chartPendapatan->getResultArray() as $cp) {
            $pendapatanPerBulan[$cp['bulan'] - 1] = $cp['pendapatan'];
        }

        $filterPenjualan = $this->request->getVar('bulan');
        if ($filterPenjualan) {
            $penjualan = $this->penjualanModel->select('nm_pro as nama,sum(banyak_brg) as jumlah')->where('MONTH(tgl_inp)', $filterPenjualan)->where('YEAR(tgl_inp)', date('Y'))->groupBy('nama')->orderBy('jumlah', 'desc')->paginate(3, 'penjualan');
        } else {
            $penjualan = $this->penjualanModel->select('nm_pro as nama,sum(banyak_brg) as jumlah')->where('YEAR(tgl_inp)', date('Y'))->groupBy('nama')->orderBy('jumlah', 'desc')->paginate(3, 'penjualan');
        }
        // dd(count($penjualan));
        $topPenjualanNama = [];
        $topPenjualanJumlah = [];
        for ($i = 0; $i < count($penjualan); $i++) {
            $topPenjualanNama[$i] = $penjualan[$i]['nama'];
            $topPenjualanJumlah[$i] = $penjualan[$i]['jumlah'];
        }

        //Jumlah Desain
        $nDesain = $this->produksiModel->select('sum(jmlh_brg) as total')->where('status', 'Design')->findAll();
        if (empty($nDesain[0]['total'])) {
            $nDesain[0]['total'] = 0;
        }
        // dd($nDesain);
        //Jumlah Sablon
        $nSablon = $this->produksiModel->select('sum(jmlh_brg) as total')->where('status', 'Sablon')->findAll();
        if (empty($nSablon[0]['total'])) {
            $nSablon[0]['total'] = 0;
        }
        // dd($nSablon);
        //Jumlah Terjual
        $nPenjualan = $this->penjualanModel->select('sum(banyak_brg) as total')->findAll();
        if (empty($nPenjualan[0]['total'])) {
            $nPenjualan[0]['total'] = 0;
        }
        // dd($nPenjualan);
        $data = [
            'title' => 'Dashboard',
            'nProduksi' => $nProduksi[0]['total'],
            'nEtalase' => $nEtalase[0]['total'],
            'nOpname' => $nOpname[0]['total'],
            'nDesain' => $nDesain[0]['total'],
            'nSablon' => $nSablon[0]['total'],
            'nPenjualan' => $nPenjualan[0]['total'],
            'penjualanNama' => $topPenjualanNama,
            'penjualanJumlah' => $topPenjualanJumlah,
            'bul' => $bul,
            'filter' => $filter,
            'filterPenjualan' => $filterPenjualan,
            'pendapatanPerBulan' => $pendapatanPerBulan,
            'totalPenjualan' => number_format($totalPenjualan[0]['total']),
        ];
        return view('admin/dashboard', $data);
    }
}
