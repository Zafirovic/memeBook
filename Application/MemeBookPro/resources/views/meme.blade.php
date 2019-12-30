
@extends('layouts.app')
@section('content')
    @if(request()->has('category_id'))
        @if(\App\User::is_followed_category(request()->category_id))
            <a href="{{route('category.follow',request()->category_id)}}" class="pull-right btn btn-info">UnFollow</a>
            @elseif( \App\User::is_unfollowed_category(request()->category_id))
                <a href="{{route('category.unfollow',request()->category_id)}}" class="pull-right btn btn-info">Follow</a>
        @else
            <a href="{{route('category.follow',request()->category_id)}}" class="pull-right btn btn-info">Follow</a>
        @endif
    @endif

    @foreach($memes as $meme)
    <div class="meme" style="background: black;width: 500px;height: 500px;padding: 20px;">
        <img style="width: 100%;" src="images/memes/{{$meme->image}}" alt="">
        <h1>{{$meme->title}}</h1>
        <h4>{{$meme->text}}</h4>
    </div>

@endforeach
    <ul>
        @foreach($categories as $category)
        <li><a href="/?category_id={{$category->id}}">{{$category->name}}</a></li>
            @endforeach
    </ul>
@stop
