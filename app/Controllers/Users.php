<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        $data = [
            'users' => $userModel->select('id, username, full_name, role')->findAll()
        ];

        return view('users/index', $data);
    }
    public function new()
    {
        helper('form');
        return view('users/new');
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->validateData($data, [
            'username' => 'required|alpha_dash|min_length[4]|max_length[50]|is_unique[users.username]',
            'full_name' => 'required|max_length[100]',
            'role' => 'required|in_list[Administrator,Manager,Cashier,Staff]',
            'password' => 'required|min_length[12]',
        ])) {
            return redirect()->back()->withInput();
        }
        $validated = $this->validator->getValidated();
        $validated['password'] = password_hash($validated['password'], PASSWORD_DEFAULT);
        $validated['created_at'] = date('Y-m-d H:i:s');
        (new UserModel())->insert($validated);
        return redirect()->to('/users');
    }

    public function edit(int $id)
    {
        $user = (new UserModel())->select('id, username, full_name, role')->find($id);
        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        helper('form');
        return view('users/edit', ['user' => $user]);
    }

    public function update(int $id)
    {
        $model = new UserModel();
        $user = $model->find($id);
        if (! $user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = $this->request->getPost();
        if (! $this->validateData($data, [
            'username' => 'required|alpha_dash|min_length[4]|max_length[50]',
            'full_name' => 'required|max_length[100]',
            'role' => 'required|in_list[Administrator,Manager,Cashier,Staff]',
            'password' => 'permit_empty|min_length[12]',
        ])) {
            return redirect()->back()->withInput();
        }
        $validated = $this->validator->getValidated();
        $otherUser = $model->where('username', $validated['username'])->where('id !=', $id)->first();
        if ($otherUser) {
            return redirect()->back()->withInput()->with('error', 'Username already exists.');
        }
        if ($validated['password'] === '') {
            unset($validated['password']);
        } else {
            $validated['password'] = password_hash($validated['password'], PASSWORD_DEFAULT);
        }
        $model->update($id, $validated);
        return redirect()->to('/users');
    }
}
