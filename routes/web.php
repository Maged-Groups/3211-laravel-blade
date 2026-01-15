<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    InitController,
    AuthController,
    UserController,
    PostController,
    PostStatusController,
    ReactionTypeController,
    CommentController,
    ReplyController
};


Route::view('/', 'index');

Route::controller(PostController::class)
    ->prefix("posts")->group(function () {
        Route::get('deleted', 'deleted');
        Route::get('{id}/restore', 'restore');
    });

Route::resources([
    'users' => UserController::class,
    'post-statuses' => PostStatusController::class,
    'reaction-types' => ReactionTypeController::class,
    'posts' => PostController::class,
    'comments' => CommentController::class,
    'replies' => ReplyController::class,
]);

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('forget-password', 'forget_password');
    Route::post('reset-password', 'reset_password');
    Route::post('change-password', 'change_password');
    Route::get('active-sessions', 'active_sessions');
    Route::get('logout-current', 'logout_current');
    Route::get('logout-all', 'logout_all');
    Route::get('logout-others', 'logout_others');
});

Route::controller(InitController::class)->prefix('init')->group(
    function () {
        Route::get('models', 'models');
        Route::get('seed', 'seed');
        Route::get('db-fresh', 'dbFresh');
        Route::get('db-fresh-seed', 'dbFreshSeed');
        Route::get('fixes', 'fixes');
        Route::get('resources', 'resources');
    }
);

Route::fallback(fn() => view('404'));
