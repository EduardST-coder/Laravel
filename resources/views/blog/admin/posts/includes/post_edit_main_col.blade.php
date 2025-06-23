@php /** @var \Illuminate\Support\MessageBag $errors */ @endphp

@if ($errors->any())
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ $errors->first() }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ session('success') }}
    </div>
@endif
