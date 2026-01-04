<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index(Course $course)
    {
        $posts = $course->posts()->whereNull('parent_id')->with('user', 'replies')->latest()->get();

        return view('dosen.forum.index', compact('course', 'posts'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate(['content' => 'required|string']);

        $course->posts()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->input('parent_id'),
        ]);

        return back()->with('success', 'Post created.');
    }

    public function show(Course $course, Post $post)
    {
        $post->load('user', 'replies.user');

        return view('dosen.forum.show', compact('course', 'post'));
    }
}
