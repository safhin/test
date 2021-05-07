<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('cat_url', $slug)->first();
        $posts = Post::where('category_id', $category->id)->paginate(8);
        return view('frontend.category',[
            'posts' => $posts,
            'category' => $category,
        ]);
    }
}
