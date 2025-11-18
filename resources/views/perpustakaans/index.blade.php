@extends('layout')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('content')
    <h1>Perpustakaan</h1>
    <a href="{{ route('perpustakaans.create') }}" class="btn-create">Create New Book</a>
    
    @if ($message = Session::get('success'))
        <div>
            {{ $message }}
        </div>
    @endif

    <table>
        <thead">
            <tr class="table-header">
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>ISBN</th>
                <th>Cover</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>    
        </thead> 
        <tbody> 
            @foreach ($perpustakaans as $perpustakaan)
            <tr>
                <td>{{ $perpustakaan->title }}</td>
                <td>{{ $perpustakaan->author }}</td>
                <td>{{ $perpustakaan->publisher }}</td>
                <td>{{ $perpustakaan->year }}</td>
                <td>{{ $perpustakaan->isbn }}</td>
                <td>
                    <img src="{{ asset('storage/covers/' . $perpustakaan->cover) }}" alt="Cover"/>
                </td>
                <td>{{ $perpustakaan->description }}</td>
                <td>{{ $perpustakaan->category }}</td>
                <td>
                    <a href="{{ route('perpustakaans.show', $perpustakaan->id) }}" class="btn-show">Show</a>
                    <a href="{{ route('perpustakaans.edit', $perpustakaan->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('perpustakaans.destroy', $perpustakaan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection