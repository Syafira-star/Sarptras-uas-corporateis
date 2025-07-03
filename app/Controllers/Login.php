<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function process()
{
    $username = $this->request->getPost('username');
    $password = trim($this->request->getPost('password'));

    $userModel = new \App\Models\UserModel();
    $user = $userModel->where('username', $username)->first();
    
    if ($user && $user['password'] === sha1($password)) {
        session()->set([
            'logged_in' => true,
            'username'  => $user['username'],
            'nama'      => $user['nama_lengkap'],
            'role'      => $user['role']
        ]);
        return redirect()->to('/dashboard'); // redirect setelah login berhasil
    } else {
        return redirect()->to('login')->with('error', 'Username atau password salah.');
    }
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
