<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'role:admin'])->name('admin.index');

// Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
//     Route::get('/', [IndexController::class, 'index'])->name('index');
//     Route::resource('/roles', RoleController::class);
//     Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
//     Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
//     Route::resource('/permissions', PermissionController::class);
//     Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
//     Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
//     Route::get('/users', [UserController::class, 'index'])->name('users.index');
//     Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//     Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
//     Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
//     Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
//     Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
//     Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
// });

Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/logs', [ProductController::class, 'logs'])->name('products.logs');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/movie/{movie}', [ProductController::class, 'destroy'])->name('movie.destroy');
});


// Route::get('/products', [ProductController::class, 'index'])->name('products');
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
// Route::resource('products', ProductController::class);



require __DIR__ . '/auth.php';
