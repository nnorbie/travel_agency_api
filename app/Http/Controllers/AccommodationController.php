<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;

class AccommodationController extends Controller
{
    // GET /api/accommodations - Get all accommodations
    public function index()
    {
        return Accommodation::with('trip')->get();
    }

    // POST /api/accommodations - Create a new accommodation
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        return Accommodation::create($validated);
    }

    // GET /api/accommodations/{id} - Get a specific accommodation
    public function show($id)
    {
        return Accommodation::with('trip')->findOrFail($id);
    }

    // PUT /api/accommodations/{id} - Update an accommodation
    public function update(Request $request, $id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
        ]);

        $accommodation->update($validated);
        return $accommodation;
    }

    // DELETE /api/accommodations/{id} - Delete an accommodation
    public function destroy($id)
    {
        $accommodation = Accommodation::findOrFail($id);
        $accommodation->delete();
        return response()->noContent();
    }
}
