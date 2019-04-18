<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function showprofile()
    {
        $user = Auth::user();
        return view('home.profile')
            ->with('user', $user);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function edit($id)
    {
        $user = Auth::user()->find($id);
        return view('home.editProfile')
            ->with('user', $user);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user()->find($id);
        $rules = [
            'name' => 'required',
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()
                ->action('UserController@edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        //update
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()
            ->action('UserController@edit', $id);
    }
}
