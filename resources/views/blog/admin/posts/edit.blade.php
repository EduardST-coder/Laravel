@extends('layouts.main')

@section('content')
    @php /** @var \App\Models\BlogPost $item */ @endphp
    @include('blog.admin.posts.includes.result_messages')

    <form method="POST" action="{{ $item->exists ? route('blog.admin.posts.update', $item->id) : route('blog.admin.posts.store') }}">
        @csrf
        @if ($item->exists)
            @method('PATCH')
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('blog.admin.posts.includes.post_edit_main_col')
            </div>
            <div class="col-md-3">
                @include('blog.admin.posts.includes.post_edit_add_col')
            </div>
        </div>
    </form>
@endsection
