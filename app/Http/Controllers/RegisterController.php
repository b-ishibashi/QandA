<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);

        // validate
        if ($validator->fails()) {
            return redirect('/add')
                ->withErrors($validator)
                ->withInput();
        }

        // create user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->image = basename(asset('storage/noimage.jpg'));
        $user->save();

        Auth::loginUsingId($user->id);

        //ログインメッセージセット
        session()->flash('success', 'ログインしました');

        return redirect('/home');
    }
}
