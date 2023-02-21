<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Myth\Auth\Password;

/**
 * @property UserModel $userModel
 */

class UsersController extends BaseController
{

    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $currentPage = $this->request->getVar('page_users') ? $this->request->getVar('page_users') : 1;
        $data = [
            'title' => 'Data Users',
            'users' => $this->userModel->paginate(5, 'users'),
            'pager' => $this->userModel->pager,
            'currentPage' => $currentPage,
        ];
        return view('admin/users/index', $data);
    }

    public function update($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'email' => 'required|is_unique[users.email,id,' . $id . ']',
        ], [
            'username' => [
                'required' => 'Username harus diisi',
            ],
            'email' => [
                'required' => 'Email harus diisi',
                'is_unique' => 'Email sudah terdaftar'
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());;
        }

        $this->userModel->save([
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'email' => $this->request->getVar('email'),
        ]);

        return redirect()->back()->with('success', 'Data berhasil diubah');
    }

    public function passw($id)
    {
        // dd($this->request->getVar());
        $validation = \Config\Services::validation();
        $validation->setRules([
            'password' => 'required|min_length[8]',
            'password_confirm' => 'matches[password]',
        ], [
            'password' => [
                'required' => 'Password harus diisi',
                'min_length' => 'Kata sandi kurang dari 8 karakter'
            ],
            'password_confirm' => [
                'matches' => 'Tidak sama dengan Kata Sandi',
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->listErrors());;
        }

        $this->userModel->save([
            'id' => $id,
            'password_hash' => Password::hash($this->request->getVar('password')),
        ]);
        return redirect()->back()->with('success', 'Password berhasil diubah');
    }
}
