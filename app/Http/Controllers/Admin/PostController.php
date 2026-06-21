<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('author');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('author_id')) {
            $query->where('author_id', $request->author_id);
        }

        $posts = $query->latest()->paginate(15)->withQueryString();
        $authors = \App\Models\User::whereIn('role', ['admin', 'doctor'])->get();

        return view('admin.posts.index', compact('posts', 'authors'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $validated['author_id'] = auth()->id();
        $validated['image'] = $imagePath;

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Tạo bài viết thành công.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $imagePath = $post->getRawOriginal('image');
        if ($request->hasFile('image')) {
            if ($imagePath && !preg_match('/^(https?:\/\/|data:)/i', $imagePath)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $validated['image'] = $imagePath;

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật bài viết thành công.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Xóa bài viết thành công.');
    }
}

