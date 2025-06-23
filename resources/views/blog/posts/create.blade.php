<?php
@extends('layouts.main')

@section('content')
    <form method="POST" action="{{ route('blog.posts.store') }}">
        @csrf
        <div><input type="text" name="title" placeholder="Заголовок" required></div>
        <div><textarea name="content_raw" placeholder="Текст" required></textarea></div>
        <div><button type="submit">Створити</button></div>
    </form>
@endsection
