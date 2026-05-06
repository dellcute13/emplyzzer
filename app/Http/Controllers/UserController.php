<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // public function userData()
    // {
    //     $users = User::latest()->paginate(2);
    //     return view('user.user-data', compact('users'));
    // }

    public function userData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = User::query();

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $users = $query->paginate(10)->withQueryString();

        $totalUsers = User::count();
        $adminCount = User::where('role', 'Administrator')->count();
        $staffManagerCount = User::whereIn('role', ['Manager', 'Staff'])->count();

        $onlineCount = User::where('last_activity', '>=', now()->subMinutes(2))->count();

        return view('user.user-data', compact('users', 'sort', 'onlineCount', 'totalUsers', 'adminCount', 'staffManagerCount'));
    }

    public function userAdd()
    {
        return view('user.user-add');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'role'     => 'required|string',
                'password' => 'required|string|min:8',
                'status'   => 'required|in:Active,Inactive',
            ]);

            $user = new User();
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->role     = $request->role;
            $user->password = Hash::make($request->password);
            $user->status   = $request->status;
            $user->last_login    = now();
            $user->last_activity = now();
            $user->save();

            DB::commit();

            return redirect()->route('users.user-data')
                ->with('success', 'User berhasil ditambahkan');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Tambah user gagal: ' . $e->getMessage());
        }
    }
}
