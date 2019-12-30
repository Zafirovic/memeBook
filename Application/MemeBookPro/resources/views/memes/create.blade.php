
@extends('layouts.app')
@section('content')
    <form method="post" action="{{route('store.meme')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="imageInput">Image</label>
            <input type="file" name="image" class="form-control" id="imageInput">
{{--            <small id="emailHelp" class="form-text text-muted">Proslediti sliku(meme) koji zelite ubaciti</small>--}}
        </div>
        <div class="form-group">
            <label for="titleInput">Title</label>
            <input type="text" name="title" class="form-control" id="titleInput" placeholder="Title">
        </div>
        <div class="form-group">
            <label for="textInput">Text</label>
            <input type="text" name="text" class="form-control" id="textInput" placeholder="Text">
        </div>
        <div>
            <h5><b>Choose the category of your meme:</b></h5>
            <h1></h1>
        </div>
        <div>
            <select name="category_id" id="selectCategoryId">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
            </select>
        </div>
        <div>
            <hr>
            <hr>
            <hr>
        </div>
        <button type="submit" class="btn btn-primary">Make Meme</button>
    </form>
    @stop
