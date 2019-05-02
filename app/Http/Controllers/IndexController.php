<?php

namespace App\Http\Controllers;

use App\Question;
use App\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        return Auth::check()
            ? $this->questions($request)
            : $this->welcome();
    }

    protected function questions(Request $request)
    {
        $q = (string)$request->input('q');
        $tag_id = $request->input('tag_id');
        $tag = $tag_id ? Tag::findOrFail($tag_id) : null;

        $maxKeywords = 6; // 適当な分割数の上限を設定（無制限にしたい場合は -1）
        $keywords = preg_split('/(?:\p{Z}|\p{Cc})++/u', $q, $maxKeywords, PREG_SPLIT_NO_EMPTY);

        $query = Question::query();

        if ($tag_id) {
            $query->whereHas('tags', function (Builder $query) use ($tag_id) {
                $query->where('question_tag.tag_id', $tag_id);
            });
        }

        foreach ($keywords as $keyword) {
            $query->where(function (Builder $query) use ($keyword) {
                $query
                    ->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('body', 'like', '%' . $keyword . '%');
            });
        }

        $questions = $query->orderBy('id', 'desc')
            ->paginate(10)
            ->appends(compact('q', 'tag_id'));

        return view('questions.index')
            ->with(compact('questions', 'q', 'tag'));
    }

    protected function welcome()
    {
        $unresolvedQuestions = Question::unresolved()->take(2)->orderByDesc('id')->get();
        return view('welcome')
            ->with(compact('unresolvedQuestions'));
    }
}
