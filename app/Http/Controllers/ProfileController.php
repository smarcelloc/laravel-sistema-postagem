<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\Profile\UpdateRequest;

class ProfileController extends Controller
{
    /**
     * Index the user's profile.
     *
     * @return Response
     */
    public function index()
    {
        return view('auth.profile');
    }

    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(UpdateRequest $request)
    {
        $user = User::find(auth()->user()->id);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->timezone = $request->timezone;

        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('home');
    }


    /**
     * Update the user's profile.
     *
     * @param  Request  $request
     * @return Response
     */
    public function delete()
    {
        $id = auth()->user()->id;

        if ($id != 1) {
            User::destroy($id);
            auth()->logout();
        }

        return redirect('/');
    }
}
