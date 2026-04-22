<?php

namespace App\Http\Controllers;

use iluminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return view('dashboard-admin');
    }

    public function petugas()
    {
        return view('dashboard-petugas');
    }

    public function pasien()
    {
        return view('dashboard-pasien');
    }

}
