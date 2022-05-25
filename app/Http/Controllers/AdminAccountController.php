<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AdminAccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function adminDashboard(){

        $posts = BlogPost::with('user')->latest()->paginate(10);
        return view('admin.index', compact('posts'));
    }

    public function fetchExternalPosts(Request $request){

        $response = Http::get($request->fetch);
        // true for array, false for object
        $external_posts = json_decode($response->body(), false);

        $count = 0;
        $blogPost = new BlogPost();
        foreach($external_posts->data as $post){
            $postExists = $blogPost->where('title', $post->title)->first();
            if(!$postExists){
                $count++;
                $blogPost->user_id = Auth::user()->id;
                $blogPost->name = 'Admin';
                $blogPost->title = $post->title;
                $blogPost->slug = Str::slug($post->title);
                $blogPost->description = $post->description;
                $blogPost->publication_date = $post->publication_date;
                $blogPost->published = 1;
                $blogPost->save();
            }
        }

        Session::flash('success', $count.' posts fetched successfully');
        return redirect()->back();

//        return response()->json([
//            'success' => true,
//            'message' => $count.' posts has been populated from api'
//        ]);
    }

}
