<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of users (admin only).
     */
    public function index(Request $request)
{
    $query = User::query();

    // Filtering
    if ($request->has('role') && $request->role !== '') {
        $query->where('role', $request->role);
    }

    if ($request->has('search') && $request->search !== '') {
        $query->where('email', 'like', '%' . $request->search . '%');
    }

    $users = $query->paginate(10);

    return view('admin.users.index', [
        'users' => $users
    ]);
}

}
