<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProduksiModel;

class ProduksiController extends BaseController
{
    protected $ProduksiModel;
    public function __construct()
    {
        $this->ProduksiModel = new ProduksiModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $produksi = $this->ProduksiModel->search($keyword);
        } else {
            $produksi = $this->ProduksiModel;
        }
        $currentPage = $this->request->getVar('page_produksi') ? $this->request->getVar('page_produksi') : 1;

        $data = [
            'title' => 'Data Produksi',
            'produksi' => $produksi->paginate(5, 'produksi'),
            'pager' => $this->ProduksiModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];
        return view('admin/produksi/index', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_brg' => 'required',
            'bahan' => 'required',
            'ukuran' => 'required',
            'jmlh_brg' => 'required',
            'harga' => 'required',
            'ket' => 'required',
            'tgl_pro' => 'required',
        ], [
            'nama_brg' => [
                'required' => 'Nama barang harus diisi',
            ],
            'bahan' => [
                'required' => 'Bahan harus diisi'
            ],
            'ukuran' => [
                'required' => 'Ukuran harus diisi'
            ],
            'jmlh_brg' => [
                'required' => 'Jumlah barang harus diisi'
            ],
            'harga' => [
                'required' => 'Harga harus diisi'
            ],
            'ket' => [
                'required' => 'Keterangan harus diisi'
            ],
            'tgl_pro' => [
                'required' => 'Tanggal produksi harus diisi'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $this->ProduksiModel->save([
            'tgl_pro' => $this->request->getVar('tgl_pro'),
            'nama_brg' => $this->request->getVar('nama_brg'),
            'bahan' => $this->request->getVar('bahan'),
            'ukuran' => $this->request->getVar('ukuran'),
            'jmlh_brg' => $this->request->getVar('jmlh_brg'),
            'harga' => $this->request->getVar('harga'),
            'ket' => $this->request->getVar('ket'),
        ]);

        return redirect()->back()->with('success', 'Data Produksi Berhasil Ditambahkan');
    }

    public function detail()
    {
        $data = [
            'title' => 'Detail Proses Produksi',
        ];
        return view('admin/produksi/detail', $data);
    }

    public function destroy($id_pro)
    {
        $this->ProduksiModel->where('id_pro', $id_pro)->delete();
        return redirect()->back()->with('success', 'Data Produksi Berhasil dihapus');
    }
}
