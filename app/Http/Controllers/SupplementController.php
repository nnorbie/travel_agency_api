<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;

class SupplementController extends Controller
{
    // GET /api/supplements - Get all supplements
    public function index()
    {
        return Supplement::with('trip')->get();
    }

    // POST /api/supplements - Create a new supplement
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'difficulty_level' => 'nullable|string',
        ]);

        return Supplement::create($validated);
    }

    // GET /api/supplements/{id} - Get a specific supplement
    public function show($id)
    {
        return Supplement::with('trip')->findOrFail($id);
    }

    // PUT /api/supplements/{id} - Update a supplement
    public function update(Request $request, $id)
    {
        $supplement = Supplement::findOrFail($id);
        $validated = $request->validate([
            'trip_id' => 'required|exists:trips,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'difficulty_level' => 'nullable|string',
        ]);

        $supplement->update($validated);
        return $supplement;
    }

    // DELETE /api/supplements/{id} - Delete a supplement
    public function destroy($id)
    {
        $supplement = Supplement::findOrFail($id);
        $supplement->delete();
        return response()->noContent();
    }
}
