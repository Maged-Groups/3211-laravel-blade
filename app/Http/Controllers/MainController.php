<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
class MainController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('comments', 'reactions')->whereNot('user_id', auth()->id())->latest()->take(10)->get();
        return view('index', compact('posts')); // ['posts' => $posts]
    }
}