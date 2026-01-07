<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function solutions()
    {
        return view('solution');
    }

    public function pricing()
    {
        return view('pricing');
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function catalog(Request $request)
    {
        $productsPerPage = 8;

        // TEMP data (replace with Product::paginate later)
        $totalProducts = 48;
        $products = collect(range(1, $totalProducts));

        $paginatedProducts = $products->forPage(
            $request->get('page', 1),
            $productsPerPage
        );

        return view('catalog', [
            'products' => $paginatedProducts,
            'totalProducts' => $totalProducts,
            'productsPerPage' => $productsPerPage
        ]);
    }

    public function login_register()
    {
        return view('login-register');
    }

    public function login()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $rules = [
            'role'        => 'required|in:administrator,distributor,retailer,publisher',
            'business_name'   => 'nullable|string|max:255',
            'contact_person'  => 'nullable|string|max:255',
            'mobile'          => 'required|string|max:20',
            'email'           => 'required|email|unique:users,email',
            'address'         => 'nullable|string',
            'gst'             => 'nullable|string|max:50',
            'pan'             => 'nullable|string|max:50',
            'city'            => 'nullable|string|max:100',
            'state'           => 'nullable|string|max:100',
            'pincode'         => 'nullable|string|max:20',
            'document'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($request->usertype === 'publisher') {
            $rules['publisher_type'] = 'required|string|max:100';
        }

        if ($request->usertype === 'retailer') {
            $rules['business_category'] = 'required|string|max:100';
        }

        if ($request->usertype === 'distributor') {
            $rules['business_category'] = 'required|string|max:100';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('document')) {
            $data['document'] = $request->file('document')->store('documents', 'public');
        }

        $data['password'] = Hash::make('123456'); // temp password

        User::create($data);

        return back()->with('success', 'Application submitted successfully');
    }

    public function login_submit(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();

            // Role based redirect
            switch ($user->role) {
                case 'administrator':
                    return redirect()->route('admin.dashboard');
                case 'distributor':
                    return redirect()->route('distributor.dashboard');
                case 'retailer':
                    return redirect()->route('retailer.dashboard');
                case 'publisher':
                    return redirect()->route('publisher.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['email' => 'Invalid role']);
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }
}
