<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Repository\ICategoryRepository;
use App\Repository\IPostRepository;
use App\Repository\ITagRepository;
use Illuminate\Http\Request;
use App\Traits\ImageUpload;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    private $postRepository;
    private $categoryRepostory;
    private $tagRepository;

    public function __construct(IPostRepository $postRepository, ICategoryRepository $categoryRepostory, ITagRepository $tagRepository)
    {
        $this->postRepository = $postRepository;
        $this->categoryRepostory = $categoryRepostory;
        $this->tagRepository = $tagRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->all();
        return view('backend.posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tagRepository->all();
        $categories = $this->categoryRepostory->all();
        return view('backend.posts.create',[
            'tags' => $tags,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    use ImageUpload;
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'image' => 'required|image',
            'tag_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'sticky' => 'nullable',
            'slug' => 'nullable',
        ]);
        $post = Post::create([
            'title' => $request->title,
            'tag_id' => $request->tag_id,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'sticky' => !empty($request->sticky) ? $request->sticky : 'off',
            'image' => 'image.jpg',
            'user_id' => auth()->user()->id,
            'slug' => strtolower(str_replace(" ","-",$request->title)),
        ]);
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/image'),$imageName);
            $post->image = '/image/'.$imageName;
            $post->save();
        }
        Session::flash('success', 'Post created successfully');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $posts = $this->postRepository->all();
        return view('backend.main')->with('posts',$posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $tags = $this->tagRepository->all();
        $categories = $this->categoryRepostory->all();
        return view('backend.posts.edit',[
            'tags' => $tags,
            'categories' => $categories,
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request,[
            'title' => 'required|max:255',
            'image' => 'sometimes|required',
            'tag_id' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'sticky' => 'nullable'
        ]);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->tag_id = $request->tag_id;
        $post->category_id = $request->category_id;
        $post->sticky = !empty($request->sticky) ? $request->sticky : 'off';

        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('image'),$imageName);
            $post->image = '/image/'.$imageName;
        }
        $post->save();
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return redirect()->back();
    }
}
