<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::all();

        return $posts;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $postStatuses = PostStatus::orderBy('type', 'asc')->get();

        return view('posts.create', [
            'postStatuses' => $postStatuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $thumbnail = $request->file('thumbnail');

        $thumbnail_path = $thumbnail->store('thumbnails');

        $postData = $request->all();
        $postData['user_id'] = auth()->id(); // Temporary user_id
        $postData['thumbnail'] = $thumbnail_path;
        // return  $postData;

        $post = Post::create($postData);

        if ($post) {

            // Increment user posts count in session
            $posts_count = session('user_posts_count', 0) + 1;
            session(['user_posts_count' => $posts_count]);

            return redirect()->route('posts.show', $post->id)->with('success', 'Post Created Successfully');
        }

        return redirect()->back()->with('error', 'Cannot create the post now, please try again later.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'postStatus']);

        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        return $post->delete() ? 'Post Deleted Successfully' : 'Cannot delete the post now, please try again later.';

    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        Gate::authorize('delete', $post);

        return $post->restore() ? 'Post Restored Successfully' : 'Cannot restore the post now, please try again later.';

    }

    public function deleted()
    {
        $posts = Post::onlyTrashed()->active()->modified()->get();

        return $posts;
    }
}
