<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    // GET /api/trips - Get all trips with related data
    public function index()
    {
        return Trip::with('accommodations', 'supplements', 'country')->get();
    }

    // POST /api/trips - Create a new trip
    public function store(Request $request)
    {
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer',
        ]);

        return Trip::create($validated);
    }

    // GET /api/trips/{id} - Get a specific trip
    public function show($id)
    {
        return Trip::with('accommodations', 'supplements', 'country')->findOrFail($id);
    }

    // PUT /api/trips/{id} - Update a trip
    public function update(Request $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $validated = $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric',
            'duration' => 'nullable|integer',
        ]);

        $trip->update($validated);
        return $trip;
    }

    // DELETE /api/trips/{id} - Delete a trip
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        $trip->delete();
        return response()->noContent();
    }
}
