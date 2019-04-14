@extends('layouts.default')

@section('title', 'QandA')

@section('header')
<ul class="nav navbar">
    <li class="nav-item">
        <a class="nav-link active text-white h3" href="/home">QandA</a>
    </li>
    <li class="nav-item">
        User: <a class="nav-link active text-dark" href="/home/profile">{{ $user->name }}</a>
    </li>
</ul>
@endsection

@section('content')
@endsection
