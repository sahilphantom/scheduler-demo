<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = $request->user()->posts()->get(['id', 'title', 'body', 'created_at', 'updated_at']);

        return response()->json(['data' => $posts]);
    }
}
