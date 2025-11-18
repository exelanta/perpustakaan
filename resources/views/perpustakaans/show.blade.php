@extends('layout')

@section('content')
    <h1>{{ $perpustakaan->title }}</h1>

    <p>{{ $perpustakaan->author }}</p>

    <p>{{ $perpustakaan->publisher }}</p>

    <p>{{ $perpustakaan->year }}</p>

    <p>{{ $perpustakaan->isbn }}</p>

    <div>
        <img src="{{ asset('storage/covers/' . $perpustakaan->cover) }}" alt="Cover"/>
    </div>

    <p>{{ $perpustakaan->description }}</p>

    <p>{{ $perpustakaan->category }}</p>

    <a href="{{ route('perpustakaans.index') }}">Back to List</a>
    @endsection