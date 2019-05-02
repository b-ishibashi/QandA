@extends('layouts.default')

@section('title', 'QandA')

@section('content')
    <div id="wrapper">
        <div class="container">
            <h1 class="text-center mb-3">プロフィールの編集</h1>
            <section class="profile-block">
                <form method="post" action="{{ action('UserController@update', $user) }}" class="form-group" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <label class="user-icon text-center position-relative mx-auto d-block">
                        <p class="click-to-upload-avatar">画像を変更</p>
                        <img src="{{ asset($user->avatar) }}" class="rounded-circle border" width="180" height="180">
                        <input type="file" name="avatar" style="visibility: hidden; width: 0; height: 0;">
                    </label>
                    <table class="table table-borderless">
                        <tr><th>名前: </th><td><input class="form-control" type="text" name="name" value="{{ old('name') ?? $user->name }}"></td></tr>
                        @if($errors->has('name'))
                            <tr><th></th><td><small class="text-danger">*{{ $errors->first('name') }}</small></td></tr>
                        @endif
                        <tr><th>メールアドレス: </th><td><input class="form-control" type="text" name="email" value="{{ old('email') ?? $user->email }}"></td></tr>
                        @if($errors->has('email'))
                            <tr><th></th><td><small class="text-danger">*{{ $errors->first('email') }}</small></td></tr>
                        @endif
                        <tr><th></th><td><input class="btn btn-primary" type="submit" value="更新する"></td></tr>
                    </table>
                </form>
            </section>
        </div>
    </div>
@endsection

@push('jquery')
    <script>
        'use strict';

        $(function() {
            $('.user-icon input').change(function(event) {
                const url = URL.createObjectURL(event.target.files[0]);
                $('.user-icon img').attr('src', url);
            });
        });
    </script>
@endpush
