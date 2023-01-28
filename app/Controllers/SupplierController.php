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
        $data = [
            'title' => 'Data Supplier',
            'supplier' => $this->SupplierModel->findAll(),
        ];

        return view('admin/supplier/index', $data);
    }
    //Save Data ke Database
    public function store()
    {
        $data = [
            'nama_sup' => esc($this->request->getPost('nama_sup')),
            'alamat_sup' => esc($this->request->getPost('alamat_sup')),
            'no_hp' => esc($this->request->getPost('no_hp')),
        ];
        $this->SupplierModel->insert($data);

        return redirect()->back()->with('success', 'Data Supplier Berhasil Ditambahkan');
    }
    public function update($id_sup)
    {
        $data = [
            'nama_sup' => esc($this->request->getPost('nama_sup')),
            'alamat_sup' => esc($this->request->getPost('alamat_sup')),
            'no_hp' => esc($this->request->getPost('no_hp')),
        ];
        $this->SupplierModel->update($id_sup, $data);

        return redirect()->back()->with('success', 'Data Supplier Berhasil Diubah');
    }
    public function destroy($id_sup)
    {
        $this->SupplierModel->where('id_sup', $id_sup)->delete();
        return redirect()->back()->with('success', 'Data Supplier Berhasil dihapus');
    }
}
