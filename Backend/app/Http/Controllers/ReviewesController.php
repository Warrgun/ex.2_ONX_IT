<?php

namespace App\Http\Controllers;

use App\Models\reviewes;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;

class ReviewesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review_arr = reviewes::with('book')->get();

        return response()->json($review_arr);
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
            'book_id' => 'required|exists:books,id',
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:0|max:5',
            'review' => 'required|string',
        ]);

        $review_data = reviewes::create([
            'book_id' => $request->book_id,
            'name' => Str::title($request->name),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json($review_data, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(reviewes $reviewes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reviewes $reviewes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:0|max:5',
            'review' => 'required|string',
        ]);

        $review = reviewes::findOrFail($id);
        $review->update($validated);

        return response()->json(['message' => 'Review updated'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $review = reviewes::findOrFail($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted successfully'], 200);
    }
}
