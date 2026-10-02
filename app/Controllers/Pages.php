<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index(): string
    {
        return view('pos/home', ['title' => 'Home']);
    }

    public function about(): string
    {
        return view('pos/about', ['title' => 'About']);
    }
}
