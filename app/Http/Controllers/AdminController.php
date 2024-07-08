<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Member;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $topProducts = Product::orderBy('total_disewa', 'desc')
                            ->take(3)
                            ->get();

         return view('admin.home.dashboard', compact('topProducts'));
    }

    public function updateMember(Request $request, $id)
    {
        $request->validate([
            'id_member' => 'required|exists:members,id_member',
        ]);

        $user = User::find($id);
        if ($user) {
            $user->id_member = $request->id_member;
            $user->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function customers()
    {
        $customers = User::where('role', 'customer')->with('member')->get();
        $members = Member::all(); // Mengambil semua data member
        return view('admin.data_akun.customers', compact('customers', 'members'));
    }

}
