<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('user-index');
        $users = User::latest()->get()->except(['id' => 1]);
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->timezone = $request->timezone;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->role()->sync($request->roles);

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('user-show');
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('user-edit');
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        if ($user->id != 1) {
            $user->email = $request->email;
            $user->name = $request->name;
            $user->timezone = $request->timezone;

            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            $user->save();
            $user->role()->sync($request->roles);
        }

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $this->authorize('user-destroy');
            $user->delete();
        }

        return redirect()->route('user.index');
    }
}
