@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <div id="wrapper">
        <div class="container">
            <h1 class="text-center mb-3">プロフィールの編集</h1>
            <section class="profile-block">
                <table class="table table-borderless">
                    <form method="post" action="{{ action('UserController@update', $user) }}" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <tr><th>名前: </th><td><input class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}"></td></tr>
                        @if($errors->has('name'))
                            <tr><th></th><td><small class="text-danger">*{{ $errors->first('name') }}</small></td></tr>
                        @endif
                        <tr><th></th><td><input class="btn btn-primary" type="submit" value="更新する"></td></tr>
                    </form>
                </table>
            </section>
        </div>
    </div>
@endsection
