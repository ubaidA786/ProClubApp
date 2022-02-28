<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\DefaultController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })
    ->name('dashboard');

Route::get('organization/check', [
    OrganizationController::class,
    'check',
])->name('organization.check');

Route::get('default', [DefaultController::class, 'index'])->name('default');

// Users

Route::get('users', [UserController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UserController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UserController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UserController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UserController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UserController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UserController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Media

Route::get('media', [MediaController::class, 'index'])
    ->name('media')
    ->middleware('auth');

Route::get('media/create', [MediaController::class, 'create'])
    ->name('media.create')
    ->middleware('auth');

Route::post('media', [MediaController::class, 'store'])
    ->name('media.store')
    ->middleware('auth');

Route::get('media/{media}/edit', [MediaController::class, 'edit'])
    ->name('media.edit')
    ->middleware('auth');

Route::put('media/{media}', [MediaController::class, 'update'])
    ->name('media.update')
    ->middleware('auth');

Route::delete('media/{media}', [MediaController::class, 'destroy'])
    ->name('media.destroy')
    ->middleware('auth');

Route::put('media/{media}/restore', [MediaController::class, 'restore'])
    ->name('media.restore')
    ->middleware('auth');
// Organization

Route::get('organizations', [OrganizationController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');

Route::get('organization/create', [OrganizationController::class, 'create'])
    ->name('organization.create')
    ->middleware('auth');

Route::post('organization', [OrganizationController::class, 'store'])
    ->name('organization.store')
    ->middleware('auth');

Route::get('organization/{organizations}/edit', [
    OrganizationController::class,
    'edit',
])
    ->name('organization.edit')
    ->middleware('auth');

Route::put('organization/{organizations}', [
    OrganizationController::class,
    'update',
])
    ->name('organization.update')
    ->middleware('auth');

Route::delete('organization/{organizations}', [
    OrganizationController::class,
    'destroy',
])
    ->name('organization.destroy')
    ->middleware('auth');

Route::put('organization/{organizations}/restore', [
    OrganizationController::class,
    'restore',
])
    ->name('organization.restore')
    ->middleware('auth');
