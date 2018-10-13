<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $data['key'] = config('shutterstock.key');
        $data['secret'] = config('shutterstock.secret');

        return view('app', $data);
    }
}
