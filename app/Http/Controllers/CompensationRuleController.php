<?php

namespace App\Http\Controllers;

use App\Models\CompensationRule;
use Illuminate\Http\Request;

class CompensationRuleController extends Controller
{
    public function index()
    {
        return response()->json(
            CompensationRule::with('category')->get()
        );
    }

    public function store(Request $request)
{
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0|gte:min_amount',
        ]);

        $compensationRule = CompensationRule::create([
            'category_id' => $request->category_id,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
        ]);

        return response()->json($compensationRule);
    }

    public function show(string $id)
{
    $rule = CompensationRule::with('category')->find($id);

    if (!$rule) {
        return response()->json([
            'message' => 'Compensation rule not found'
        ], 404);
    }

    return response()->json($rule);
}

   public function update(Request $request, string $id)
{
    $rule = CompensationRule::find($id);

    if (!$rule) {
        return response()->json([
            'message' => 'Compensation rule not found'
        ], 404);
    }

    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'min_amount' => 'required|numeric|min:0',
        'max_amount' => 'required|numeric|min:0|gte:min_amount',
    ]);

    $rule->update([
        'category_id' => $request->category_id,
        'min_amount' => $request->min_amount,
        'max_amount' => $request->max_amount,
    ]);

    return response()->json($rule);
}

    public function destroy(string $id)
{
    $rule = CompensationRule::find($id);

    if (!$rule) {
        return response()->json([
            'message' => 'Compensation rule not found'
        ], 404);
    }

    $rule->delete();

    return response()->json([
        'message' => 'Compensation rule deleted successfully'
    ]);
}
}