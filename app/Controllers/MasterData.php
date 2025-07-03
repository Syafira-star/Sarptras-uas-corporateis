<?php

namespace App\Controllers;

class MasterData extends BaseController
{
    public function index()
    {
        return view('master-data', ['title' => 'Master Data']);
    }
}
