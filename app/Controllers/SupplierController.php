<?php

namespace App\Controllers;

use App\Controllers\BaseController;

/**
 * @property SupplierModel $SupplierModel
 */

class SupplierController extends BaseController
{
    //Menampilkan Data
    public function index()
    {
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $supplier = $this->SupplierModel->search($keyword);
        } else {
            $supplier = $this->SupplierModel;
        }
        $currentPage = $this->request->getVar('page_supplier') ? $this->request->getVar('page_supplier') : 1;

        $data = [
            'title' => 'Data Supplier',
            'supplier' => $supplier->paginate(5, 'supplier'),
            'pager' => $this->SupplierModel->pager,
            'currentPage' => $currentPage,
            'keyword' => $keyword
        ];

        return view('admin/supplier/index', $data);
    }
    //Save Data ke Database
    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_sup' => 'required|is_unique[supplier.nama_sup]',
            'alamat_sup' => 'required',
            'no_hp' => 'required',
        ], [
            'nama_sup' => [
                'required' => 'Nama harus diisi',
                'is_unique' => 'Nama supplier sudah terdaftar'
            ],
            'alamat_sup' => [
                'required' => 'Alamat harus diisi'
            ],
            'no_hp' => [
                'required' => 'Nomor HP harus diisi'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $this->SupplierModel->save([
            'nama_sup' => $this->request->getVar('nama_sup'),
            'alamat_sup' => $this->request->getVar('alamat_sup'),
            'no_hp' => $this->request->getVar('no_hp'),
        ]);

        return redirect()->back()->with('success', 'Data Supplier Berhasil Ditambahkan');
    }
    public function update($id_sup)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_sup_edit' => 'required|is_unique[supplier.nama_sup]',
            'alamat_sup_edit' => 'required',
            'no_hp_edit' => 'required',
        ], [
            'nama_sup_edit' => [
                'required' => 'Nama harus diisi',
                'is_unique' => 'Nama supplier sudah terdaftar'
            ],
            'alamat_sup_edit' => [
                'required' => 'Alamat harus diisi'
            ],
            'no_hp_edit' => [
                'required' => 'Nomor HP harus diisi'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());
        }

        $data = [
            'nama_sup_edit' => esc($this->request->getPost('nama_sup_edit')),
            'alamat_sup_edit' => esc($this->request->getPost('alamat_sup_edit')),
            'no_hp_edit' => esc($this->request->getPost('no_hp_edit')),
        ];
        $this->SupplierModel->update($id_sup, $data);

        return redirect()->to('supplier')->with('success', 'Data Supplier Berhasil Diubah');
    }
    public function destroy($id_sup)
    {
        $this->SupplierModel->where('id_sup', $id_sup)->delete();
        return redirect()->back()->with('success', 'Data Supplier Berhasil dihapus');
    }
}
