<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalProducts' => Product::count(),
            'totalOrders'   => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'doneOrders'    => Order::where('status', 'done')->count(),
            'products'      => Product::all(),
        ]);
    }

    public function editProfile()
    {
        return view('admin.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update name and email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // Update password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user = \App\Models\User::find(Auth::id());

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Profile berhasil diupdate!');
    }

    public function tables()
{
    $tables = \App\Models\Table::with('order.user')->orderBy('table_number')->get();
    return view('admin.tables.index', compact('tables'));
}
}
