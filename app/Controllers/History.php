<?php

namespace App\Controllers;

class History extends BaseController
{
    public function index()
    {
        return view('history', ['title' => 'History Sistem']);
    }
}
