<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRolePermission;

/**
 * Todo: ADMIN ROUTES
 */
Route::controller(App\Http\Controllers\Admin\LoginController::class)->group(function () {
    Route::get('/vrm-admin', 'index')->name('/vrm-admin');
    Route::post('/vrm-admin/access', 'login');
    Route::get('/vrm-admin/logout', 'logout')->name('/vrm-admin/logout');
});
// ? Vormia Manage
Route::group(['prefix' => 'vrm'], function () {
    Route::middleware([CheckRolePermission::class . ':permission'])->group(function () {

        Route::middleware([CheckRolePermission::class . ':user'])->group(function () {
            // ? Users
            Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
                Route::get('/users', 'index');
                Route::post('/users/save', 'store');
                Route::post('/users/update', 'update');
                Route::get('/users/edit/{page?}', 'edit'); // Edit
                Route::get('/users/delete', 'delete'); // Delete
                Route::get('/users/status/{action?}', 'valid'); // Valid
                Route::get('/users/{view}', 'open'); // Open
            });
        });

        // ? Roles
        Route::controller(App\Http\Controllers\Admin\RoleController::class)->group(function () {
            Route::get('/roles', 'index');
            Route::post('/roles/save', 'store');
            Route::post('/roles/update', 'update');
            Route::get('/roles/edit/{page?}', 'edit');
            Route::get('/roles/delete', 'delete');
            Route::get('/roles/{action}', 'valid');
        });
    });

    // Protect a group of routes
    Route::middleware([CheckRolePermission::class . ':dashboard'])->group(function () {
        // ? Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('vrm/dashboard')->middleware(CheckRolePermission::class . ':dashboard');;
    });

    // Protect a group of routes
    Route::middleware([CheckRolePermission::class . ':setup'])->group(function () {
        // ? Setup
        Route::group(['prefix' => 'setup'], function () {
            // ? Continent Hierarchies
            Route::controller(App\Http\Controllers\Setup\ContinentController::class)->group(function () {
                Route::get('/continent', 'index');
                Route::post('/continent/save', 'store');
                Route::post('/continent/update', 'update');
                Route::get('/continent/edit/{page?}', 'edit');
                Route::get('/continent/delete', 'delete');
                Route::get('/continent/{action}', 'valid');
            });

            // ? Currency
            Route::controller(App\Http\Controllers\Setup\CurrencyController::class)->group(function () {
                Route::get('/currency', 'index');
                Route::post('/currency/save', 'store');
                Route::post('/currency/update', 'update');
                Route::get('/currency/edit/{page?}', 'edit'); // Edit
                Route::get('/currency/delete', 'delete'); // Delete
                Route::get('/currency/status/{action?}', 'valid'); // Valid
                Route::get('/currency/{view}', 'open'); // Open
            });
        });
    });
});


// TODO: LOGIN
Route::controller(App\Http\Controllers\Front\LoginController::class)->group(function () {
    Route::get('/account-signin', 'index')->name('account-signin');
    Route::post('/account-signin/access', 'login');
    Route::get('/account-signin/logout', 'logout')->name('account-signin/logout');
});

// TODO: REGISTER
Route::controller(App\Http\Controllers\Front\RegisterController::class)->group(function () {
    Route::get('/account-signup', 'index')->name('account-signup');
    Route::post('/account-signup', 'register');
    Route::get('/account-verification', 'verification');
    Route::post('/account-verification/reverify', 'reverify');
});


// TODO: LIVE WIRE
// Route::get('/', App\Livewire\LiveSetting::class)->name('home');

Route::get('/',[App\Http\Controllers\BlogController::class, 'home'])->name('home');

Route::middleware([CheckRolePermission::class . ':blog'])->group(function () {

    Route::group(['prefix' => 'blog'], function () {

        // Route::get('/',[App\Http\Controllers\BlogController::class, 'home'])->name('home');
        Route::get('/blogs',[App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
        // Route::get('/blogcontent/{id}',[App\Http\Controllers\BlogController::class, 'showBlog'])->name('blogcontent');
        Route::get('/blogcontent',[App\Http\Controllers\BlogController::class, 'showBlog'])->name('blogcontent');
        Route::get('/contact-us', [App\Http\Controllers\BlogController::class, 'contactUs'])->name('contact');


        Route::get('/create', [App\Http\Controllers\BlogController::class, 'createBlog']);
        Route::post('/save', [App\Http\Controllers\BlogController::class, 'store'])->name('storeblog');
    });
});