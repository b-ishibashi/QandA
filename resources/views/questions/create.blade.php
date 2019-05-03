@extends('layouts.default')

@section('title', 'QandA')

@section('content')
<form method="post" action="{{ action('QuestionController@confirm') }}" class="form-group" enctype="multipart/form-data">
    @csrf
    <div class="container post-form">
        <div class="title-form row">
            <label for="title" class="col-sm-3">タイトル</label>
            <input class="form-control col-sm-9" type="text" name="title" id="title" value="{{ old('title') }}">
            @if ($errors->has('title'))
                <label class="col-sm-3"></label><p class="col-sm-9 text-danger">*{{ $errors->first('title') }}</p>
            @else
                <label class="col-sm-3"></label><p class="col-sm-9"></p>
            @endif
        </div>
        <div class="body-form row">
            <label for="body" class="col-sm-3">質問内容</label>
            <textarea class="form-control col-sm-9" maxlength="2000" name="body" id="body">{{ old('body') }}</textarea>
            @if ($errors->has('body'))
                <label class="col-sm-3"></label><p class="col-sm-7 text-danger">*{{ $errors->first('body') }}</p>
            @else
                <label class="col-sm-3"></label><p class="col-sm-7"></p>
            @endif
        </div>
        <div class="tag mb-4 row">
            <label for="tag" class="col-sm-3">タグ選択</label>
            <select class="form-control col-sm-5" id="tag" name="tag">
                @foreach($tags as $tag)
                    <option value="{{ $tag }}">{{ $tag }}</option>
                @endforeach
            </select>
        </div>
        <div class="send text-center">
            <input class="btn btn-primary mb-2" type="submit" value="次へ"><br>
            <a href="{{ action('IndexController@index') }}">戻る</a>
        </div>
    </div>
</form>
@endsection



