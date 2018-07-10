<?php

namespace App\Http\Controllers\Admin;

use App\Entity\HomeCallDoctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $callDoctorsAtHome = HomeCallDoctor::all();
        return view('Admin.index', compact('callDoctorsAtHome'));
    }

}
