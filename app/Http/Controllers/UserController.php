<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $search = request()->input('search', false);
        $per_page = request()->input('per_page', 15);

        $users = User::when($search, function ($query, $search) {
            $query->where('name', 'like', "%$search%");
        })
            ->paginate($per_page);

        return view('user.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * $users->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'whatsapp' => 'required|unique:users,whatsapp',
                'bidang' => 'required|in:bidang keuangan,bidang kesyabandaran,bidang pengelola bmn dan persediaan,bidang kepegawaian atau tata usaha,bidang kepelabuhan',
                'password' => 'required|confirmed|min:8',
            ]);

            $user = User::create($payload);
            $role = Role::whereName($payload['bidang'])->first();
            if (!$role) {
                DB::rollBack();
                return back()->with('error', "Role not found for the specified bidang, please add role first.");
            }

            if (!$user->hasRole($payload['bidang'])) {
                $user->addRole($role);
            }
            DB::commit();

            return redirect()->route('user.index')
                ->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while creating the user.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        DB::beginTransaction();

        try {
            $payload = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'whatsapp' => 'required|unique:users,whatsapp,' . $user->id,
                'bidang' => 'required|in:bidang keuangan,bidang kesyabandaran,bidang pengelola bmn dan persediaan,bidang kepegawaian atau tata usaha,bidang kepelabuhan',
                'password' => 'nullable|confirmed|min:8',
                'password_confirmation' => 'sometimes|required_with:password',
            ], [
                'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
                'whatsapp.unique' => 'Whatsapp sudah digunakan oleh pengguna lain.',
            ]);

            if ($request->password) {
                $payload['password'] = $request->password;
            } else {
                unset($payload['password']);
            }
            $user->update($payload);

            $role = Role::whereName($request->bidang)->first();
            if (!$role) {
                DB::rollBack();
                return back()->with('error', "Role not found for the specified bidang.");
            }
            $user->syncRoles([$role]);
            DB::commit();

            return redirect()->route('user.index')
                ->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while updating the user.');
        }
    }


    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->route('user.index')
            ->with('success', 'User deleted successfully');
    }
}
