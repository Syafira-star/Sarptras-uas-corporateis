<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{

    public function logout()
    {
        session()->destroy(); // Hapus semua data session
        return redirect()->to('/login'); // Arahkan ke halaman login
    }
}
