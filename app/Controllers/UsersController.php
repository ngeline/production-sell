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
}
