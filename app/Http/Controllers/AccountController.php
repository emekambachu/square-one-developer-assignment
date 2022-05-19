<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function App\Http\Controllers\Auth\verificationToken;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $posts = BlogPost::where('user_id', Auth::user()->id)
            ->with('user')->has('user')->paginate();
        return view('users.dashboard', compact('posts'));
    }

    public function createPost(){
        return view('users.create-post');
    }

    public function storePost(Request $request){

        $input = $request->all();
        $rules = array(
            'title' => 'required|unique:blog_posts,title',
            'description' => 'required',
            'published' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                "success" => false,
                "errors" => $validator->getMessageBag()->toArray()
            ]);
        }

        $input['slug'] = str::slug($input['title']);
        $input['user_id'] = Auth::user()->id;
        $message = 'Your post has been saved as draft';
        if($input['published'] === '1'){
            $input['published'] = 1;
            $input['publication_date'] = Carbon::now()->format('Y-m-d H:i:s');
            $message = 'Your post has been published';
        }

        try{
            BlogPost::create($input);

        }catch(\Exception $error) {
            return response()->json([
                "success" => false,
                "message" => $error->getMessage()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}
