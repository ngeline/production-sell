<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Myth\Auth\Password;

class ProfileController extends BaseController
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profile',
        ];

        return view('admin/profile/index', $data);
    }

    public function update($id)
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'email' => 'required|is_unique[users.email,id,' . $id . ']',
            'user_image' => 'max_size[user_image,1024]|is_image[user_image]|mime_in[user_image,image/jpg,image/jpeg,image/png]',
        ], [
            'username' => [
                'required' => 'Username harus diisi',
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'is_unique' => 'Email sudah terdaftar'
            ],
            'user_image' => [
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'yang anda pilih bukan gambar',
                'mime_in' => 'yang anda pilih bukan gambar'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput();
        }

        $fileImage = $this->request->getFile('user_image');

        //cek gambar, apkah tetap gambar lama
        if ($fileImage->getError() == 4) {
            $namaImage = $this->request->getVar('image_lama');
            // dd($namaSampul);
        } else {
            //ambil nama sampul
            $namaImage = $fileImage->getRandomName();
            //pindahkan file ke folder img
            $fileImage->move('assets/img', $namaImage);
            //hapus sampul lama
            if ($this->request->getVar('image_lama') != 'default.png') {
                //hapus gambar
                unlink('assets/img/' . $this->request->getVar('image_lama'));
            }
        }

        $this->userModel->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
            'user_image' => $namaImage,
        ]);

        if ($this->request->getVar('password') != "") {
            $this->userModel->save([
                'id' => $id,
                'password_hash' => Password::hash($this->request->getVar('password')),
            ]);
        }
        return redirect()->back()->with('success', 'Profil berhasil diubah');;
    }
}
