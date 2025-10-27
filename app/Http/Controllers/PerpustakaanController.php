<?php

namespace App\Http\Controllers;

use App\Models\Perpustakaan;
use Illuminate\Http\Request;

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
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'isbn' => 'required',
            'cover' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        Perpustakaan::create($request->all());

        return redirect()->route('perpustakaans.index')
            ->with('success', 'Perpustakaan created successfully.');
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
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'isbn' => 'required',
            'cover' => 'required',
            'description' => 'required',
            'category' => 'required',
        ]);

        $perpustakaans->update($request->all());

        return redirect()->route('perpustakaans.index')
            ->with('success', 'Perpustakaan updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Perpustakaan $perpustakaan)
    {
        $perpustakaan->delete();

        return redirect()->route('perpustakaans.index')
            ->with('success', 'Perpustakaan deleted successfully'); 
    }
}
