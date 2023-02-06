<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OpnameModel;
use App\Models\PenjualanModel;
use App\Models\ProduksiModel;

class PenjualanController extends BaseController
{
    protected $penjualanModel;
    protected $produksiModel;
    protected $opnameModel;
    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
        $this->produksiModel = new ProduksiModel();
        $this->opnameModel = new OpnameModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $penjualan = $this->penjualanModel->search($keyword);
        } else {
            $penjualan = $this->penjualanModel->orderBy('created_at', 'desc');
        }
        $produksi = $this->produksiModel->select('id_pro,nama_brg,harga')->findAll();
        $currentPage = $this->request->getVar('page_produksi') ? $this->request->getVar('page_produksi') : 1;
        $data = [
            'title' => 'Data Penjualan',
            'produksi' => $produksi,
            'penjualan' => $penjualan->paginate(5, 'penjualan'),
            'pager' => $this->penjualanModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];
        return view('admin/penjualan/index', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_barang' => 'required',
            'tgl_input' => 'required',
            'marketplace' => 'required',
            'banyak' => 'required',
        ], [
            'nama_barang' => [
                'required' => 'Nama barang harus diisi',
            ],
            'tgl_input' => [
                'required' => 'Bahan harus diisi'
            ],
            'marketplace' => [
                'required' => 'Ukuran harus diisi'
            ],
            'banyak' => [
                'required' => 'Jumlah barang harus diisi'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $this->penjualanModel->save([
            'id_pro' => $this->request->getVar('nama_barang'),
            'marketplace' => $this->request->getVar('marketplace'),
            'tgl_inp' => $this->request->getVar('tgl_input'),
            'nm_pro' => $this->produksiModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['nama_brg'],
            'banyak_brg' => $this->request->getVar('banyak'),
            'total_penj' => $this->request->getVar('total_penj'),
        ]);

        $stokAwal = $this->opnameModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['jmlh_opn'];
        $stokAkhir = intval($stokAwal) - intval($this->request->getVar('banyak'));

        $this->opnameModel->update($this->opnameModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['id_opn'], [
            'jmlh_opn' => $stokAkhir
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambah Data Penjualan');
    }

    public function update($id_penj)
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_barang' => 'required',
            'tgl_input' => 'required',
            'marketplace' => 'required',
            'banyak' => 'required',
        ], [
            'nama_barang' => [
                'required' => 'Nama barang harus diisi',
            ],
            'tgl_input' => [
                'required' => 'Bahan harus diisi'
            ],
            'marketplace' => [
                'required' => 'Ukuran harus diisi'
            ],
            'banyak' => [
                'required' => 'Jumlah barang harus diisi'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $stokTambahan = $this->penjualanModel->where('id_penj', $id_penj)->first()['banyak_brg'];
        $stokAwal = $this->opnameModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['jmlh_opn'];
        $stokSebelumUpdate = intval($stokAwal) + intval($stokTambahan);

        $this->penjualanModel->save([
            'id_penj' => $id_penj,
            'id_pro' => $this->request->getVar('nama_barang'),
            'marketplace' => $this->request->getVar('marketplace'),
            'tgl_inp' => $this->request->getVar('tgl_input'),
            'nm_pro' => $this->produksiModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['nama_brg'],
            'banyak_brg' => $this->request->getVar('banyak'),
            'total_penj' => $this->request->getVar('total_penj'),
        ]);


        $stokAkhir = $stokSebelumUpdate - intval($this->request->getVar('banyak'));

        $this->opnameModel->update($this->opnameModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['id_opn'], [
            'jmlh_opn' => $stokAkhir
        ]);

        return redirect()->back()->with('success', 'Berhasil Update Data Penjualan');
    }

    public function destroy($id_penj)
    {
        $this->penjualanModel->where('id_penj', $id_penj)->delete();
        return redirect()->back()->with('success', 'Data Penjualan Berhasil dihapus');
    }
}
