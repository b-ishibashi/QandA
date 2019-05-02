<?php

namespace App\Http\Controllers;

use App\Question;
use App\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function show(Question $question)
    {
        $user = Auth::user();
        $answers = $question->answers;

        return view('questions.show')
            ->with(compact('question', 'answers', 'user'));
    }

    public function create()
    {
        return view('questions.create')
            ->with('tags', Tag::DEFAULTS);
    }

    public function confirm(Request $request)
    {
        if ($response = $this->validateQuestionThenFailed($request)) {
            return $response;
        }

        return view('questions.confirm')
            ->with('request', $request);
    }

    public function store(Request $request)
    {
        if ($response = $this->validateQuestionThenFailed($request)) {
            return $response;
        }

        // create question
        $question = new Question();

        // 質問のフィールド埋め
        $question->title = $request->title;
        $question->body = $request->body;
        $question->user()->associate(Auth::user());
        $tag = Tag::firstOrCreate(['title' => $request->tag]);

        // DBトランザクション
        DB::transaction(function () use ($question, $tag) {
            // 質問の新規作成
            $question->save();
            // 質問にタグを追加
            $question->tags()->attach($tag);
        });

        //2重送信防止
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * @param Request $request
     * @return null|\Illuminate\Http\RedirectResponse
     */
    protected function validateQuestionThenFailed(Request $request): ?RedirectResponse
    {
        $rules = [
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ];

        $validator = Validator::make($request->all(), $rules);

        // バリデーション
        if ($validator->fails()) {
            return redirect('/questions/create')
                ->withErrors($validator)
                ->withInput();
        }

        return null;
    }
}
