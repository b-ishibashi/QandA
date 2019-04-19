<?php

namespace App\Http\Controllers;

use App\Question;
use App\Tag;
use App\Answer;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function create()
    {
        $categories = array(
            'インターネット・コンピュータ',
            'エンターテイメント',
            '生活・文化',
            '社会・経済',
            '健康と医療',
            'ペット',
            'グルメ',
            '住まい',
            '花・ガーデニング',
            '育児',
            '旅行・観光',
            '写真',
            '手芸・ハンドクラフト',
            'スポーツ',
            'アウトドア',
            '美容・ビューティー',
            'ファッション',
            '恋愛・結婚',
            '趣味・ホビー',
            'ゲーム',
            '乗り物',
            '芸術・人文',
            '学問・雑談',
            '日記・雑談',
            'ニュース',
            '地域情報'
        );

        return view('home.create')
            ->with('categories', $categories);
    }

    public function confirm(Request $request)
    {
        $rules = [
            'title' => 'required|max:50',
            'body' => 'required|max:2000',
        ];

        $validator = Validator::make($request->all(), $rules);

        // バリデーション
        if ($validator->fails())
        {
            return redirect('/home/create')
                ->withErrors($validator)
                ->withInput();
        }

        return view('home.confirm')
            ->with('request', $request);
    }

    public function store(Request $request)
    {
        // create question
        $question = new Question();
        $tag = new Tag();

        $question->title = $request->title;
        $question->body = $request->body;
        $question->user()->associate(Auth::user());
        $tag->title = $request->category;

        $question->save();
        $tag->save();
        $question->tags()->attach($tag);

        //2重送信防止
        $request->session()->regenerateToken();
        return redirect('/home');
    }

    public function show($id)
    {
        $question = Question::all()->find($id);
        $answers = Question::all()->find($id)->answers;
        $user = Auth::user();
        return view('home.show')
            ->with([
                'question' => $question,
                'answers' => $answers,
                'user' => $user
            ]);
    }
}
