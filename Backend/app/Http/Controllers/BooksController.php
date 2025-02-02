<?php

namespace App\Http\Controllers;

use App\Models\books;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allowed = ['title', 'author', 'book_created'];
        $sortBy = $request->query('sort_by', 'title');
        $order = $request->query('order', 'asc');

        if (!in_array($sortBy, $allowed)) {
            return response()->json(['error' => 'invalid sort field'], 400);
        }

        $book_arr = books::orderBy($sortBy, $order)->get();

        return response()->json($book_arr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'book_created' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $book = books::create([
            'title' => Str::title($request->title),
            'author' => Str::title($request->author),
            'book_created' => $request->book_created,
            'description' => $request->description,
        ]);

        return response()->json($book, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(books $books)
    {
        //
    }
}
