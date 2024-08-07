<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'appName' => 'MyPerpus',
            'title' => 'Home'
        ];
        return view('home/index', $data);
    }
}
