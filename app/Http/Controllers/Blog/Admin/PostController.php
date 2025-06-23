<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\BlogPostRepository;

class PostController extends Controller
{
    /**
     * @var BlogPostRepository
     */
    private $blogPostRepository;

    public function __construct()
    {
        $this->blogPostRepository = app(BlogPostRepository::class);
    }

    public function index()
    {
        return 'Admin Posts Index';
    }

    public function edit($id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }

        return view('blog.admin.posts.edit', compact('item'));
    }
}
