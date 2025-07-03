<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
{
    $session = session();

    if (!$session->get('logged_in')) {
        return redirect()->to('/login')->with('error', 'Silakan login dulu.');
    }
}

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // kosong
    }
}
