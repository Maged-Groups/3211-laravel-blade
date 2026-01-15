<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Models\Post;
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
        // $posts = Cache::remember('all_posts', now()->addSeconds(20), function () {
        //     $per_page = $request->per_page ?? 10;

        //     return Post::with('user')->modified()->active()->paginate($per_page);
        // });


        if (Cache::has('all_posts')) {
            $posts = Cache::get('all_posts');
        } else {
            $per_page = $request->per_page ?? 10;

            // $posts = Post::with('user')->modified()->active()->paginate($per_page);
            // get only last 10 posts
            $posts = Post::with('user')->modified()->active()->latest()->paginate($per_page);

            Cache::forever('all_posts', $posts);
        }

        // $posts = Post::with('user')->modified()->recent()->get();
        // $posts = DB::table('posts')
        //     ->join('post_statuses', 'posts.post_status_id', '=', 'post_statuses.id')
        //     ->join('users', 'users.id', '=', 'posts.user_id')
        //     ->select('posts.*', 'post_statuses.type as post_status', 'users.name as user_name')
        //     ->whereIn('posts.post_status_id', [1, 2, 7])
        //     ->paginate($per_page);

        $posts = PostCollection::make($posts);

        $postsData = 'successResponse';

        return $postsData;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        $postData = $request->all();
        $postData['user_id'] = auth()->user()->id;

        $post = Post::create($postData);

        if ($post) {
            // Clear cache
            Cache::forget('all_posts');

            return  'Post Created Successfully';
        }

        return  'Cannot create the post now, please try again later.';
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post =  $post->load(['user', 'postStatus', 'comments.user']);
        $post = $post->load(['user']);

        $post = PostResource::make($post);

        $postData = 'successResponse';

        return $postData;
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
