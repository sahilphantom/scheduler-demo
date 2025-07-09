<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function activeUsers()
    {
        $activeUsers = User::where('is_active', true)->get();

        return response()->json($activeUsers);
    }
}
