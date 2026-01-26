<?php

use App\Http\Controllers\SettingController;
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


// Protected Routes
Route::middleware('auth')->group(function () {
    Route::view('/', 'index')->name('home');
    Route::view('/settings', 'settings')->name('settings');
    Route::put('/settings/profile/update', [SettingController::class, 'update_profile'])->name('settings.profile.update');
    Route::put('/settings/account/update', [SettingController::class, 'update_account'])->name('settings.account.update');
    Route::put('/settings/notifications/update', [SettingController::class, 'update_notifications'])->name('settings.notifications.update');
    Route::put('/settings/password/update', [SettingController::class, 'update_password'])->name('settings.password.update');
    Route::put('/settings/privacy/update', [SettingController::class, 'update_privacy'])->name('settings.privacy.update');
    Route::put('/settings/appearance/update', [SettingController::class, 'update_appearance'])->name('settings.appearance.update');
    Route::delete('/settings/account/delete', [SettingController::class, 'delete_account'])->name('settings.account.delete');


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
        Route::post('change-password', 'change_password');
        Route::get('active-sessions', 'active_sessions');
        Route::get('logout-current', 'logout_current')->name('logout-current');
        Route::get('logout-all', 'logout_all');
        Route::get('logout-others', 'logout_others');
    });
});

// Public Routes
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('login', 'login_form')->name('login');
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('forget-password', 'forget_password');
    Route::post('reset-password', 'reset_password');
});

// Special Initialization Routes
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

// Fallback Route
Route::fallback(fn() => view('404'));
