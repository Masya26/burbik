<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function __invoke()
    {
        $product_count = Products::all()->count();
        $user_count = User::count();
        return view('admin.main.index', [
            'product_count' => $product_count,
            'user_count' => $user_count,
        ]);
    }
}
