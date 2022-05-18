<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){

        $posts = BlogPost::with('user')->paginate(10);
        return view('home', compact('posts'));
    }

    public function show($id){
        $post = BlogPost::findOrFail($id);
        return view('post-detail', compact('post'));
    }

    public function search(){

    }
}
