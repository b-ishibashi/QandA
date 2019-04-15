<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $questions = Question::all();
        return view('home.home')
            ->with([
                'user' => $user,
                'questions' => $questions
            ]);
    }

    public function showprofile()
    {
        $user = Auth::user();
        return view('home.profile')
            ->with('user', $user);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
