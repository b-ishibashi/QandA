<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $this->authorize('store', [Answer::class, $question]);

        $rules = [
            'answer' => 'required|max:1000'
        ];

        $validator = Validator::make($request->only('answer'), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        // create answer
        $answer = new Answer();
        $answer->body = $request->answer;
        $answer->user()->associate(Auth::user());
        $answer->question()->associate($question);
        $answer->save();

        //2重送信防止
        $request->session()->regenerateToken();

        return redirect()
            ->action('QuestionController@show', $question);
    }

    public function selectForBest(Question $question, Answer $answer)
    {
        $question->best_answer_id = $answer->id;
        $question->save();

        return redirect()
            ->action('QuestionController@show', $question);
    }
}
