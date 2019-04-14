<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class IndexController extends Controller
{
    // ログイン前のhome画面に関するコントローラ
    public function index()
    {
        if (Auth::check())
        {
            return view('home.home');
        } else
        {
            return view('index');
        }
    }

    public function add()
    {
        return view('add');
    }

    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|unique:users',
            'email' => 'email|unique:users',
            'password' => 'required|confirmed'
        ];

        $validator = Validator::make($request->all(), $rules);

        // validate
        if ($validator->fails())
        {
            return redirect('/add')
                ->withErrors($validator)
                ->withInput();
        } else
        {
            // create user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return redirect('/login');
    }

    public function showlogin()
    {
        return view('login');
    }

    public function dologin(Request $request)
    {
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        // validate
        if ($validator->fails())
        {
            return redirect('/login')
                ->withErrors($validator)
                ->withInput();
        }

        // ログイン検証
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('/home')
                ->with('success', 'ログインしました');
        } else
        {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')],
            ]);
        }

    }
}
