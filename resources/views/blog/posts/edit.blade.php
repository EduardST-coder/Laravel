<?php
@extends('layouts.main')

@section('content')
    <form method="POST" action="{{ route('blog.posts.update', $post) }}">
        @csrf
        @method('PUT')
        <div><input type="text" name="title" value="{{ $post->title }}" required></div>
        <div><textarea name="content_raw" required>{{ $post->content_raw }}</textarea></div>
        <div><button type="submit">Оновити</button></div>
    </form>

    <form method="POST" action="{{ route('blog.posts.destroy', $post) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Видалити</button>
    </form>
@endsection
