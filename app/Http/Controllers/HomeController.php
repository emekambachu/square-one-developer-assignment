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
        $posts = BlogPost::with('user')->where('published', 1)
            ->inRandomOrder()->paginate(10);
        $order = 'random';
        return view('home', compact('posts', 'order'));
    }

    public function indexRecent(){

        $posts = BlogPost::with('user')->where('published', 1)
            ->orderBy('publication_date', 'desc')->paginate(10);
        $order = 'recent';
        return view('home', compact('posts', 'order'));
    }

    public function show($id){
        $post = BlogPost::with('user')->where('published', 1)
            ->findOrFail($id);
        return view('post-detail', compact('post'));
    }

    public function search(Request $request){

    }
}
