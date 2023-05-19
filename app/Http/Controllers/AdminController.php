<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'superadmin']);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function activateDeactivate(Request $request,User $user)
    {
        $user->is_active = $request->input('is_active', true);
        $user->save();

        return response()->json($user);
    }
}
