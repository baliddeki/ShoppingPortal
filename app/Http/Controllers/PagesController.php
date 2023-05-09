<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function products()
    {
        return view('admin.products');
    }

    public function admin_dashboard()
    {
        return view('admin.admin_dashboard');
    }
}
