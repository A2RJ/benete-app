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


// Route::get('/', function () {
//     Role::query()->delete();
//     $role = Role::create([
//         'name' => 'admin',
//         'display_name' => 'Administrator',
//         'description' => 'Administrtor hanya dapat mengelola akun user',
//     ]);
//     $user = User::whereEmail('admin@mail.com')->first();
//     if (!$user->hasRole($role->name)) {
//         $user->addRole($role);
//     }
//     Role::create([
//         'name' => 'bidang keuangan',
//         'display_name' => 'Bidang Keuangan',
//         'description' => 'User ini hanya dapat mengelola bidang keuangan',
//     ]);
//     Role::create([
//         'name' => 'bidang kesyabandaran',
//         'display_name' => 'Bidang Kesaybandaran',
//         'description' => 'User ini hanya dapat mengelola bidang kesyabandaran',
//     ]);
//     Role::create([
//         'name' => 'bidang pengelola bmn dan persediaan',
//         'display_name' => 'Bidang Pengelola BMN dan Persediaan',
//         'description' => 'User ini hanya dapat mengelola bidang pengelola bmn dan persediaan',
//     ]);
//     Role::create([
//         'name' => 'bidang kepegawaian atau tata usaha',
//         'display_name' => 'Bidang Kepegawaian atau Tata Usaha',
//         'description' => 'User ini hanya dapat mengelola bidang kepegawaian atau tata usaha',
//     ]);
//     Role::create([
//         'name' => 'bidang kepelabuhan',
//         'display_name' => 'Bidang Kepelabuhan',
//         'description' => 'User ini hanya dapat mengelola bidang kepelabuhan',
//     ]);
// });
