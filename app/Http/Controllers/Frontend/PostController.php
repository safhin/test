<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->where('sticky', 'off')->paginate(8);
        $stickyPost = Post::orderBy('created_at','desc')->with('category')->where('sticky', 'on')->take(3)->get();
        return view('frontend.main',[
            'posts' => $posts,
            'stickyPost' => $stickyPost
        ]);
    }

    public function singlePost($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('frontend.post',[
            'post' => $post
        ]);
    }

    public function about()
    {
        return view('frontend.about');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
