<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // GET /api/countries - Get all countries with their trips
    public function index()
    {
        return Country::with('trips.accommodations', 'trips.supplements')->get();
    }

    // POST /api/countries - Create a new country
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'currency' => 'nullable|string',
            'continent' => 'nullable|string',
        ]);

        return Country::create($validated);
    }

    // GET /api/countries/{id} - Get a specific country with its trips
    public function show($id)
    {
        return Country::with('trips.accommodations', 'trips.supplements')->findOrFail($id);
    }

    // PUT /api/countries/{id} - Update a country
    public function update(Request $request, $id)
    {
        $country = Country::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'currency' => 'nullable|string',
            'continent' => 'nullable|string',
        ]);

        $country->update($validated);
        return $country;
    }

    // DELETE /api/countries/{id} - Delete a country
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();
        return response()->noContent();
    }
}
