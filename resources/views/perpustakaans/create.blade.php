@extends('layout')

@section('content')
    <h1>Create Perpustakaan</h1>

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>                
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('perpustakaans.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    <label>Title</label>
    <input type="text" name="title" value="{{ old('title') }}">
    
    <label>Author</label>
    <input type="text" name="author" value="{{ old('author') }}">
    
    <label>Publisher</label>
    <input type="text" name="publisher" value="{{ old('publisher') }}">
    
    <label>Year</label>
    <input type="text" name="year" value="{{ old('year') }}">
    
    <label>ISBN</label>
    <input type="text" name="isbn" value="{{ old('isbn') }}">
    
    <label>Cover</label>
    <input type="file" name="cover" value="{{ old('cover') }}">

    <label>Description</label>
    <input type="text" name="description" value="{{ old('description') }}">

    <label>Category</label>
    <input type="text" name="category" value="{{ old('category') }}">
    
    <button type="submit">Create</button>
    </form>
    @endsection