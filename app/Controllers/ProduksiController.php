<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OpnameModel;
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
            $produksi = $this->ProduksiModel->where('status', 'Masuk Etalase')->orderBy('created_at', 'desc');
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

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Proses Produksi',
            'pro' => $this->ProduksiModel->where('id_pro', $id)->first(),
        ];
        return view('admin/produksi/detail', $data);
    }

    public function updateProses($id_pro)
    {
        // dd($this->request->getVar());
        if ($this->request->getVar('proses1')) {
            $this->ProduksiModel->save([
                'id_pro' => $id_pro,
                'proses1' => $this->request->getVar('proses1'),
                'status' => 'Design',
            ]);
        }
        if ($this->request->getVar('proses2')) {
            $this->ProduksiModel->save([
                'id_pro' => $id_pro,
                'proses2' => $this->request->getVar('proses2'),
                'status' => 'Sablon'
            ]);
        }
        if ($this->request->getVar('proses3')) {
            $this->ProduksiModel->save([
                'id_pro' => $id_pro,
                'proses3' => $this->request->getVar('proses3'),
                'status' => 'Selesai'
            ]);
        }
        return redirect()->back()->with('success', 'Proses Berhasil Diupdate');
    }

    public function update($id_pro)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_brg' => 'required',
            'bahan' => 'required',
            'ukuran' => 'required',
            'jmlh_brg' => 'required',
            'harga' => 'required',
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
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $cekProses = $this->ProduksiModel->where('id_pro', $id_pro)->first()['proses2'];
        if ($cekProses != null) {
            return redirect()->back()->with('error', "Data sudah tidak bisa diubah");;
        }

        $this->ProduksiModel->save([
            'id_pro' => $id_pro,
            'nama_brg' => $this->request->getVar('nama_brg'),
            'bahan' => $this->request->getVar('bahan'),
            'ukuran' => $this->request->getVar('ukuran'),
            'jmlh_brg' => $this->request->getVar('jmlh_brg'),
            'harga' => $this->request->getVar('harga'),
            'ket' => $this->request->getVar('ket'),
        ]);

        return redirect()->back()->with('success', 'Data Produksi Berhasil Diubah');
    }

    public function destroy($id_pro)
    {
        $this->ProduksiModel->where('id_pro', $id_pro)->delete();
        return redirect()->back()->with('success', 'Data Produksi Berhasil dihapus');
    }
}
