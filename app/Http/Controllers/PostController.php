<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $post;

    public function __construct()
    {
        $this->post = new PostService();
    }

    public function index(Request $request)
    {
        $payload = $this->post->index($request);

        if ($payload->status === 200) {
            return view('posts.index', [
                'posts' => $payload->posts
            ]);
        }
    }

    public function show(Request $request)
    {
        $payload = $this->post->show($request);

        if ($payload->status === 200) {
            return view('posts.show', [
                'post' => $payload->post
            ]);
        }
    }
}
