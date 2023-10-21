<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    $role = Role::whereName('admin')->first();
    $admin = User::whereEmail('admin@mail.com')->firstOrFail();
    if (!$role) {
        $role = Role::create([
            'name' => 'admin',
            'display_name' => 'User Administrator', // optional
            'description' => 'User is allowed to manage and edit other users', // optional
        ]);
    }
    if (!$admin->hasRole('admin')) {
        $admin->addRole($role);
    }
    return [$role, $admin->load('roles')];
});
