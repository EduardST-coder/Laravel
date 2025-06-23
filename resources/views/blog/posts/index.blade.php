
@extends('layouts.main')

@section('content')
    <h1>Список постів</h1>

    <table>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
    </table>
@endsection
