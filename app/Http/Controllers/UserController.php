<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:user|superadministrator');
    }
    public function index()
    {
        $products = Product::inRandomOrder()->take(8)->get();
        return view('user.index')->with('products', $products);
    }
}
