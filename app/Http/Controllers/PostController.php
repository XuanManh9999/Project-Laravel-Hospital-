<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->with('author')
            ->latest()
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    public function show($id)
    {
        $post = Post::where('status', 'published')
            ->with('author')
            ->findOrFail($id);

        // Lấy các bài viết liên quan (cùng tác giả hoặc mới nhất)
        $relatedPosts = Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                $query->where('author_id', $post->author_id)
                      ->orWhereDate('created_at', '>=', now()->subDays(30));
            })
            ->with('author')
            ->latest()
            ->limit(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}

