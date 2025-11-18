<?php

namespace App\Http\Controllers;

use App\Models\Perpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perpustakaans = Perpustakaan::all();
        return view('perpustakaans.index', compact('perpustakaans'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perpustakaans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',            
            'year' => 'required|string|max:255',
            'isbn' => 'required|string|max:255',            
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        $data = $request->only(['title', 'author', 'publisher', 'year', 'isbn', 'cover', 'description', 'category']);

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $coverName = $cover->hashName();
            $coverPath = $cover->storeAs('covers', $coverName, 'public');
            $data['cover'] = $coverPath;
        }

        Perpustakaan::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'publisher' => $request->input('publisher'),
            'year' => $request->input('year'),            
            'isbn' => $request->input('isbn'),
            'cover' => $coverName,
            'description' => $request->input('description'),
            'category' => $request->input('category'),
        ]);

        return redirect()->route('perpustakaans.index')
            ->with('success', 'Perpustakaan created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Perpustakaan $perpustakaan)
    {
        return view('perpustakaans.show', compact('perpustakaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Perpustakaan $perpustakaan)
    {
        return view('perpustakaans.edit', compact('perpustakaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perpustakaan $perpustakaan)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'isbn' => 'required',
            'cover' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $coverName = $perpustakaan->cover;
        if ($coverName) {
            $coverFile = $request->file('cover');

            if ($coverFile) {
                $coverName = $coverFile->hashName();
                $coverFile->StoreAs('covers', $coverName, 'public');
            }
        }

        $perpustakaan->update([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'publisher' => $validatedData['publisher'],
            'year' => $validatedData['year'],
            'isbn' => $validatedData['isbn'],
            'cover' => $coverName,
            'description' => $validatedData['description'],
            'category' => $validatedData['category'],   
        ]);

        return redirect()->route('perpustakaans.index')
            ->with('success', 'Perpustakaan updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perpustakaan $perpustakaan)
    {
        try {
            
        if($perpustakaan->cover) {
            Storage::disk('public')->delete('storage/covers/' . $perpustakaan->cover);
        }

        $perpustakaan->delete();

        return redirect()->route('perpustakaans.index')
            ->with('success', 'Perpustakaan deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
