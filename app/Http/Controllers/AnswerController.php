<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function store($id, Request $request)
    {
        //$question = Question::all()->find($id);
        //return view('answer.create')
            //->with('question', $question);

        $rules = [
            'answer' => 'required|max:1000'
        ];

        $validator = Validator::make($request->only('answer'), $rules);

        if ($validator->fails())
        {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // create answer
        $answer = new Answer();
        $user_id = Auth::id();
        $answer->body = $request->answer;
        $answer->user_id = $user_id;
        $answer->question_id = $id;
        $answer->save();
        $answer->user()->associate(Auth::user());

        //2重送信防止
        $request->session()->regenerateToken();

        return redirect('/home/question/' . $id);
    }
}
