<?php

namespace App\Http\Controllers;

use App\Mail\NotifyCommentMail;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $user = auth()->user();
        $commentor_name = $user->name;
        $post_id = $data['post_id'];
        $post = Post::find($post_id);
        $post_owner_id = $post->user_id;
        $post_title = $post->post_title;
        $post_owner = User::find($post_owner_id);
        $post_owner_name = $post_owner->name;
        $post_owner_email = $post_owner->email;


        // Store data
        $data['user_id'] = $user->id;

        if (Comment::create($data)) {
            // Send Email notification to post owner
            $mail_data = [
                "post_id" => $post_id,
                "post_owner_id" => $post_owner_id,
                "post_owner_name" => $post_owner_name,
                "post_owner_email" => $post_owner_email,
                "commentor_name" => $commentor_name,
                "post_title" => $post_title,
            ];

            // Mail::to($post_owner_email)->send(new NotifyCommentMail());
            if (Mail::to('magedyaseengroups@gmail.com')->send(new NotifyCommentMail($mail_data))) // Static (My email for test)
                return 'Comment added and notification email sent successfully.';

            return'Comment added but failed to send notification email.';

        }

        return 'forbiddenResponse';

    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
