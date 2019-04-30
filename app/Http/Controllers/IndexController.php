<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        return Auth::check()
            ? $this->questions()
            : $this->welcome();
    }

    protected function questions()
    {
        $questions = Question::orderBy('id', 'desc')
            ->paginate(10);

        return view('questions.index')
            ->with(compact('questions'));
    }

    protected function welcome()
    {
        return view('welcome');
    }
}
