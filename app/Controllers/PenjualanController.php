<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtalaseModel;
use App\Models\PenjualanModel;
use App\Models\ProduksiModel;

class PenjualanController extends BaseController
{
    protected $penjualanModel;
    protected $produksiModel;
    protected $etalaseModel;
    public function __construct()
    {
        $this->penjualanModel = new PenjualanModel();
        $this->produksiModel = new ProduksiModel();
        $this->etalaseModel = new EtalaseModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $penjualan = $this->penjualanModel->search($keyword);
        } else {
            $penjualan = $this->penjualanModel->orderBy('created_at', 'desc');
        }
        $etalase = $this->etalaseModel->select('etalase.id_pro,etalase.nama_et,p.harga,p.ukuran,etalase.jmlh_et')->join('produksi p', 'etalase.id_pro=p.id_pro')->findAll();
        $currentPage = $this->request->getVar('page_produksi') ? $this->request->getVar('page_produksi') : 1;
        $data = [
            'title' => 'Data Penjualan',
            'etalase' => $etalase,
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

        $sisaStock = $this->etalaseModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['jmlh_et'];
        $nAkhir = intval($sisaStock) - intval($this->request->getVar('banyak'));
        if ($nAkhir <= 0) {
            return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi');
        }

        $this->penjualanModel->save([
            'id_pro' => $this->request->getVar('nama_barang'),
            'marketplace' => $this->request->getVar('marketplace'),
            'tgl_inp' => $this->request->getVar('tgl_input'),
            'nm_pro' => $this->produksiModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['nama_brg'],
            'banyak_brg' => $this->request->getVar('banyak'),
            'total_penj' => $this->request->getVar('total_penj'),
        ]);

        $stokAwal = $this->etalaseModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['jmlh_opn'];
        $stokAkhir = intval($stokAwal) - intval($this->request->getVar('banyak'));

        $this->etalaseModel->update($this->etalaseModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['id_opn'], [
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
        $stokAwal = $this->etalaseModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['jmlh_opn'];
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

        $this->etalaseModel->update($this->etalaseModel->where('id_pro', $this->request->getVar('nama_barang'))->first()['id_opn'], [
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
