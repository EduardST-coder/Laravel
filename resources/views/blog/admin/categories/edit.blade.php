@extends('layouts.main')

@section('content')
    <form method="POST" action="{{ route('blog.admin.categories.store') }}">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.categories.includes.item_edit_main_col')
                </div>
                <div class="col-md-4">
                    @include('blog.admin.categories.includes.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
