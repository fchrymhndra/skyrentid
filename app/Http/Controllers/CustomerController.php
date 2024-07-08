<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function beranda()
    {
        $categories = ['Kamera', 'Lensa', 'Stabilizer', 'Lighting', 'Audio', 'Tripod'];
        $products = Product::where('status_produk', 'on')->get();
        return view('customer.home.beranda', compact('categories', 'products'));
    }

    public function produkc()
    {
        $categories = ['Kamera', 'Lensa', 'Stabilizer', 'Lighting', 'Audio', 'Tripod'];
        $products = Product::where('status_produk', 'on')->get();
        return view('customer.produk.produkc', compact('categories', 'products'));
    }

    public function showCategory($category)
    {
        $categories = ['Kamera', 'Lensa', 'Stabilizer', 'Lighting', 'Audio', 'Tripod'];
        $products = Product::where('kategori', $category)->where('status_produk', 'on')->get();
        return view('customer.home.category', compact('categories', 'category', 'products'));
    }
}
