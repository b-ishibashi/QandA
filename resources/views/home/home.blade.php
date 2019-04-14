@extends('layouts.default')

@section('title', 'QandA')

@section('nav')
    <li class="nav-item">
        User: <a class="nav-link active text-dark" href="/home/profile">{{ $user->name }}</a>
    </li>
@endsection

@section('content')
@endsection
