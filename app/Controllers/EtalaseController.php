<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtalaseModel;
use App\Models\ProduksiModel;

class EtalaseController extends BaseController
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
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $etalase = $this->etalaseModel->select('id_et,nama_et,sum(jmlh_et) as jmlh_et,ket_et,tgl_et,created_at')->groupBy('nama_et')->search($keyword);
        } else {
            $etalase = $this->etalaseModel->select('id_et,nama_et,sum(jmlh_et) as jmlh_et,ket_et,tgl_et,created_at')->groupBy('nama_et')->orderBy('created_at', 'desc');
        }
        $produksi = $this->produksiModel->select('id_pro,nama_brg,jmlh_brg')->where('status', 'selesai')->findAll();
        $currentPage = $this->request->getVar('page_etalase') ? $this->request->getVar('page_etalase') : 1;
        $data = [
            'title' => 'Data Etalase',
            'produksi' => $produksi,
            'etalase' => $etalase->paginate(5, 'etalase'),
            'pager' => $this->etalaseModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];
        return view('admin/etalase/index', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_pro' => 'required|is_unique[etalase.id_pro]',
        ], [
            'id_pro' => [
                'required' => 'Barang harus diisi',
                'is_unique' => 'Barang sudah ada di etalase'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $produksi = $this->produksiModel->where('id_pro', $this->request->getVar('id_pro'))->first();
        $this->etalaseModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'tgl_et' => date('Y-m-d'),
            'nama_et' => $produksi['nama_brg'],
            'jmlh_et' => $this->request->getVar('jmlh_opn'),
            'ket_et' => $this->request->getVar('ket'),
        ]);

        $this->produksiModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'status' => 'Masuk Etalase'
        ]);

        return redirect()->back()->with('success', 'Data Etalase Berhasil Ditambahkan');
    }

    public function update($id_et)
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_pro' => 'required|is_unique[etalase.id_pro]',
        ], [
            'id_pro' => [
                'required' => 'Barang harus diisi',
                'is_unique' => 'Barang sudah ada di etalase'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        // $stok_awal = $this->opnameModel->where('id_opn', $id_opn)->first()['jmlh_opn'];
        // $stok_akhir = intval($stok_awal) + intval($this->request->getVar('jmlh_opn'));
        // $this->opnameModel->save([
        //     'id_opn' => $id_opn,
        //     'jmlh_opn' => $stok_akhir,
        // ]);
        $opname = $this->etalaseModel->where('id_et', $id_et)->first();
        $produksi = $this->produksiModel->where('id_pro', $this->request->getVar('id_pro'))->first();
        $this->etalaseModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'tgl_et' => date('Y-m-d'),
            'nama_et' => $opname['nama_opn'],
            'jmlh_et' => $this->request->getVar('jmlh_opn'),
            'ket_et' => $opname['ket_opn'],
        ]);

        $this->produksiModel->save([
            'id_pro' => $this->request->getVar('id_pro'),
            'status' => 'Masuk Stock Opname'
        ]);

        return redirect()->back()->with('success', 'Etalase Berhasil Diubah');
    }
}
