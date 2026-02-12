<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostStatusController;
use App\Http\Controllers\ReactionTypeController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('components', 'components')->name('components');

Route::get('components-var', function () {
    $title = 'TV SAMMan';
    $price = 10000;

    return view('components-var', compact('title', 'price'));
})->name('components-var');

// Protected Routes
Route::middleware('auth')->group(function () {

    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });

    Route::view('/settings', 'settings')->name('settings');
    Route::put('/settings/profile/update', [SettingController::class, 'update_profile'])->name('settings.profile.update');
    Route::put('/settings/account/update', [SettingController::class, 'update_account'])->name('settings.account.update');
    Route::put('/settings/notifications/update', [SettingController::class, 'update_notifications'])->name('settings.notifications.update');
    Route::put('/settings/password/update', [SettingController::class, 'update_password'])->name('settings.password.update');
    Route::put('/settings/privacy/update', [SettingController::class, 'update_privacy'])->name('settings.privacy.update');
    Route::put('/settings/appearance/update', [SettingController::class, 'update_appearance'])->name('settings.appearance.update');
    Route::delete('/settings/account/delete', [SettingController::class, 'delete_account'])->name('settings.account.delete');

    Route::controller(PostController::class)
        ->prefix('posts')->group(function () {
            Route::get('deleted', 'deleted');
            Route::get('{id}/restore', 'restore');
        });

    Route::middleware(['throttle:browse'])->group(function () {
        Route::resources([
            'users' => UserController::class,
            'post-statuses' => PostStatusController::class,
            'reaction-types' => ReactionTypeController::class,
            'posts' => PostController::class,
            'comments' => CommentController::class,
            'replies' => ReplyController::class,
        ]);
    });

    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('change-password', 'change_password');
        Route::get('active-sessions', 'active_sessions');
        Route::get('logout-current', 'logout_current')->name('logout-current');
        Route::get('logout-all', 'logout_all');
        Route::get('logout-others', 'logout_others');
    });
});

// Public Routes
Route::middleware(['throttle:50,1'])->controller(AuthController::class)->prefix('auth')->group(function () {
    Route::get('login', 'login_form')->name('login');
    Route::post('login', 'login');
    Route::get('register', 'register_form')->name('register');
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
Route::fallback(fn () => view('404'));
