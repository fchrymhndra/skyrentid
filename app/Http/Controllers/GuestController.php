<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function home()
    {
        $categories = ['Kamera', 'Lensa', 'Stabilizer', 'Lighting', 'Audio', 'Tripod'];
        $products = Product::where('status_produk', 'on')->get();
        return view('guest.home.home', compact('categories', 'products'));
    }

    public function produkg()
    {
        $categories = ['Kamera', 'Lensa', 'Stabilizer', 'Lighting', 'Audio', 'Tripod'];
        $products = Product::where('status_produk', 'on')->get();
        return view('guest.produk.produkg', compact('categories', 'products'));
    }

    public function showCategory($category)
    {
        $categories = ['Kamera', 'Lensa', 'Stabilizer', 'Lighting', 'Audio', 'Tripod'];
        $products = Product::where('kategori', $category)->where('status_produk', 'on')->get();
        return view('guest.home.category', compact('categories', 'category', 'products'));
    }
}

// namespace App\Http\Controllers;

// use App\Models\Product;
// use Illuminate\Http\Request;

// class GuestController extends Controller
// {
//     public function home()
//     {
//         $products = Product::where('status_produk', 'on')->get();
//         return view('guest.home.home', compact('products'));
//     }

//     public function produkg()
//     {
//         $products = Product::where('status_produk', 'on')->get();
//         return view('guest.produk.produkg', compact('categories', 'products'));
//     }
// }
