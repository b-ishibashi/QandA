<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $questions = Question::orderBy('id', 'desc')
            ->paginate(10);
        return view('home.home')
            ->with([
                'questions' => $questions,
            ]);
    }
}
