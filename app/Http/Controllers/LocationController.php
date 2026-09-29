<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $locations = Location::all();

         return response()->json($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
     {
          $request->validate([
               'name' => 'required|string',
               'description' => 'nullable|string',
          ]);

          $location = Location::create([
               'name' => $request->name,
               'description' => $request->description,
          ]);

          return response()->json($location);
     }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $location = Location::find($id);

         return response()->json($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $location = Location::find($id);

         $location->update([
             'name' => $request->name,
             'description' => $request->description,
    ]);

         return response()->json($location);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $location = Location::find($id);

        $location->delete();

        return response()->json([
                'message' => 'Location deleted successfully'
    ]);
    }
}
