<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session('isLoggedIn') === true) {
            return redirect()->to('/customers');
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $data = $this->request->getPost();
        if (! $this->validateData($data, [
            'username' => 'required|max_length[50]',
            'password' => 'required',
        ])) {
            return redirect()->to('/login')->withInput()->with('error', 'Enter your username and password.');
        }

        $user = (new UserModel())->where('username', trim((string) $data['username']))->first();
        if (! $user || empty($user['password']) || ! password_verify((string) $data['password'], $user['password'])) {
            return redirect()->to('/login')->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->regenerate(true);
        $session->set([
            'userId'       => (int) $user['id'],
            'username'     => $user['username'],
            'isLoggedIn'   => true,
        ]);

        return redirect()->to('/customers');
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login');
    }
}
