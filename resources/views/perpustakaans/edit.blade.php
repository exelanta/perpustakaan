@extends('layout')

@section('content')
    <h1>Edit Perpustakaan</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>                
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('perpustakaans.update', $perpustakaan->id) }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @method('PUT')
    <label>Title</label>
    <input type="text" name="title" value="{{ $perpustakaan->title }}">

    <label>Author</label>
    <input type="text" name="author" value="{{ $perpustakaan->author }}">

    <label>Publisher</label>
    <input type="text" name="publisher" value="{{ $perpustakaan->publisher }}">

    <label>Year</label>
    <input type="text" name="year" value="{{ $perpustakaan->year }}">

    <label>ISBN</label>
    <input type="text" name="isbn" value="{{ $perpustakaan->isbn }}">

    <label>Cover</label>
    <input type="file" name="cover" value="{{ $perpustakaan->cover }}">

    <label>Description</label>
    <input type="text" name="description" value="{{ $perpustakaan->description }}">

    <label>Category</label>
    <input type="text" name="category" value="{{ $perpustakaan->category }}">

    <button type="submit">Update</button>
    </form>