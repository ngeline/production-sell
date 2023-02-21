<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EtalaseModel;
use App\Models\OpnameModel;

class OpnameController extends BaseController
{
    protected $opnameModel;
    protected $etalaseModel;
    public function __construct()
    {
        $this->opnameModel = new OpnameModel();
        $this->etalaseModel = new EtalaseModel();
    }

    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $opname = $this->opnameModel->search($keyword);
        } else {
            $opname = $this->opnameModel->orderBy('created_at', 'desc');
        }
        $etalase = $this->etalaseModel->join('produksi p', 'etalase.id_pro=p.id_pro')->findAll();
        $currentPage = $this->request->getVar('page_opname') ? $this->request->getVar('page_opname') : 1;
        $data = [
            'title' => 'Data Opname',
            'etalase' => $etalase,
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
            'id_et' => 'required',
            'jmlh_opn' => 'required',
        ], [
            'id_et' => [
                'required' => 'Barang harus diisi',
            ],
            'jmlh_opn' => [
                'required' => 'jumlah harus diisi',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $etalase = $this->etalaseModel->join('produksi p', 'etalase.id_pro=p.id_pro')->where('id_et', $this->request->getVar('id_et'))->first();
        $this->opnameModel->save([
            'id_et' => $etalase['id_et'],
            'tgl_opn' => date('Y-m-d'),
            'nama_opn' => $etalase['nama_et'] . ' ukuran ' . $etalase['ukuran'],
            'jmlh_opn' => $this->request->getVar('jmlh_opn'),
            'ket_opn' => $this->request->getVar('ket'),
        ]);

        $stokAwal = $this->etalaseModel->where('id_et', $this->request->getVar('id_et'))->first()['jmlh_et'];
        $stokAkhir = intval($stokAwal) - intval($this->request->getVar('jmlh_opn'));

        $this->etalaseModel->update($this->etalaseModel->where('id_et', $this->request->getVar('id_et'))->first()['id_et'], [
            'jmlh_et' => $stokAkhir
        ]);

        return redirect()->back()->with('success', 'Data Etalase Berhasil Ditambahkan');
    }

    public function update($id_opn)
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'jmlh_opn' => 'required',
        ], [
            'nama' => [
                'required' => 'Barang harus diisi',
            ],
            'jmlh_opn' => [
                'required' => 'jumlah harus diisi',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $opname = $this->opnameModel->where('id_opn', $id_opn)->first();
        $stokMulaOpname = $opname['jmlh_opn'];
        $this->opnameModel->save([
            'id_opn' => $id_opn,
            'jmlh_opn' => $this->request->getVar('jmlh_opn'),
            'ket_opn' => $this->request->getVar('ket'),
        ]);

        $stokAwalEtalase = $this->etalaseModel->where('id_et', $opname['id_et'])->first()['jmlh_et'];
        $stokAkhir = intval($stokAwalEtalase) + intval($stokMulaOpname) - intval($this->request->getVar('jmlh_opn'));

        $this->etalaseModel->update($opname['id_et'], [
            'jmlh_et' => $stokAkhir
        ]);

        return redirect()->back()->with('success', 'Data Etalase Berhasil Diubah');
    }
}
