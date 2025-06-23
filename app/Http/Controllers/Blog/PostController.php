<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = BlogPost::all();
        return view('blog.posts.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content_raw' => 'required|string',
        ]);

        $data['content_html'] = $data['content_raw'];
        $data['slug'] = \Str::slug($data['title']);
        $data['user_id'] = 1;
        $data['category_id'] = 1;
        $data['is_published'] = true;
        $data['published_at'] = now();

        BlogPost::create($data);

        return redirect()->route('blog.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $post)
    {
        return view('blog.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content_raw' => 'required|string',
        ]);

        $data['slug'] = \Str::slug($data['title']);
        $data['content_html'] = $data['content_raw'];

        $post->update($data);

        return redirect()->route('blog.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $post)
    {
        $post->delete();
        return redirect()->route('blog.posts.index');
    }
}
