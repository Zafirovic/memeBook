@extends('layouts.app')

@section('title', 'Memes')

@section('navbar')
    @include('partials.main-navbar')
@endsection

@section('content')
    @include('meme.show-content', ['memes' => $memes, 'reasonsToReport' => $reasonsToReport])
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/meme/ReportMeme.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/meme/DeleteMeme.js') }}"></script>
@endsection
