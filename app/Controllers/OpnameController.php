<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OpnameModel;
use App\Models\ProduksiModel;

class OpnameController extends BaseController
{
    protected $opnameModel;
    protected $produksiModel;
    public function __construct()
    {
        $this->opnameModel = new OpnameModel();
        $this->produksiModel = new ProduksiModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $opname = $this->opnameModel->search($keyword);
        } else {
            $opname = $this->opnameModel->orderBy('created_at', 'desc');
        }
        $produksi = $this->produksiModel->select('id_pro,nama_brg,jmlh_brg')->where('status', 'selesai')->findAll();
        $currentPage = $this->request->getVar('page_opname') ? $this->request->getVar('page_opname') : 1;
        $data = [
            'title' => 'Data Opname',
            'produksi' => $produksi,
            'opname' => $opname->paginate(5, 'opname'),
            'pager' => $this->opnameModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];
        return view('admin/opname/index', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_pro' => 'required|is_unique[opname.id_pro]',
        ], [
            'id_pro' => [
                'required' => 'Barang harus diisi',
                'is_unique' => 'Barang sudah ada di stock opname'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $produksi = $this->produksiModel->where('id_pro', $this->request->getVar('id_pro'))->first();
        $this->opnameModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'tgl_opn' => date('Y-m-d'),
            'nama_opn' => $produksi['nama_brg'],
            'jmlh_opn' => $this->request->getVar('jmlh_opn'),
            'ket_opn' => $this->request->getVar('ket'),
        ]);

        $this->produksiModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'status' => 'Masuk Stock Opname'
        ]);

        return redirect()->back()->with('success', 'Data Opname Berhasil Ditambahkan');
    }

    public function update($id_opn)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_pro' => 'required|is_unique[opname.id_pro]',
        ], [
            'id_pro' => [
                'required' => 'Barang harus diisi',
                'is_unique' => 'Barang sudah ada di stock opname'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $stok_awal = $this->opnameModel->where('id_opn', $id_opn)->first()['jmlh_opn'];
        $stok_akhir = intval($stok_awal) + intval($this->request->getVar('jmlh_opn'));
        $this->opnameModel->save([
            'id_opn' => $id_opn,
            'jmlh_opn' => $stok_akhir,
        ]);

        $this->produksiModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'status' => 'Masuk Stock Opname'
        ]);

        return redirect()->back()->with('success', 'Stok Opname Berhasil Diubah');
    }
}
