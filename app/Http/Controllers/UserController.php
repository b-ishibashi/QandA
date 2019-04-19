<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    public function showprofile()
    {
        $user = Auth::user();
        $questions = User::find(Auth::user()->id)->questions;
        return view('home.profile')
            ->with([
                'user' => $user,
                'questions' => $questions,
            ]);
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
            'name' => 'required|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_image' => 'file|mimes:jpeg,bmp,png'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return redirect()
                ->action('UserController@edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        //プロフィール画像が変更されれば反映
        if ($request->hasFile('user_image'))
        {
            if ($request->file('user_image')->isValid())
            {
                $avatar = $request->file('user_image');
                $filePath = basename($request->user_image->store('public/userimage'));
                //300×300にリサイズ
                Image::make($avatar)->resize(320, 226)->save(storage_path('app/public/userimage/' . $filePath));
            }
        }

        //update
        $user->name = $request->name;
        $user->email = $request->email;
        //画像が変更されていれば画像変更、なければnoimageのパスを代入
        isset($filePath) ? $user->image = $filePath : $user->image = basename(asset('storage/noimage.jpg'));
        $user->save();
        return redirect()->action('UserController@showprofile');
    }
}
