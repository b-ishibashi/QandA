<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function show(User $user)
    {
        $questions = $user->questions;

        return view('users.show')
            ->with([
                'user' => $user,
                'questions' => $questions,
            ]);
    }

    public function edit(User $user)
    {
        // ユーザー情報のアップデート権限を確認
        $this->authorize('update', $user); // Gate::authorize()........と同義

        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * @param Request $request
     * @param User $user
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        // ユーザー情報のアップデート権限を確認
        $this->authorize('update', $user); // Gate::authorize()........と同義

        $rules = [
            'name' => 'required|max:30|unique:users,name,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'avatar' => 'nullable|file|mimes:jpeg,png,gif',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()
                ->action('UserController@edit', $user)
                ->withErrors($validator)
                ->withInput();
        }

        $avatar = $request->file('avatar');

        if ($avatar) {
            //300×300にリサイズ
            Image::make($avatar)
                ->resize(640, 640)
                ->save(storage_path("app/public/avatars/user-{$user->id}"));

            $user->avatar = "storage/avatars/user-{$user->id}";
        }

        //update
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        //更新メッセージセット
        session()->flash('update', '更新しました');

        return redirect()->action('UserController@show', $user);
    }
}
