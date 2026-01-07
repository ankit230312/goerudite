<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard');
    }

    public function distributor()
    {
        return view('distributor.dashboard');
    }

    public function retailer()
    {
        return view('retailer.dashboard');
    }

    public function publisher()
    {
        return view('publisher.dashboard');
    }
}
