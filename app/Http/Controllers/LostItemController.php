<?php

namespace App\Http\Controllers;

use App\Models\LostItem;
use App\Models\ActivityLog;
use App\Models\CompensationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LostItemController extends Controller
{
    public function index()
    {
        return response()->json(
            LostItem::with([
                'user',
                'category',
                'location'
            ])->get()
        );
    }

    public function edit($id)
    {
        $lostItem = LostItem::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        $categories = \App\Models\Category::all();
        $locations = \App\Models\Location::all();

        return view(
            'student.edit-report',
            compact(
                'lostItem',
                'categories',
                'locations'
            )
        );
    }

    public function show($id)
    {
        $lostItem = LostItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view(
            'student.report-details',
            compact('lostItem')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable',
            'custom_category' => 'nullable|string|max:255',
            'location_id' => 'nullable',
            'custom_location' => 'nullable|string|max:255',
            'item_name' => 'required|string',
            'description' => 'required|string',
            'compensation_offer' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'lost_date' => 'required|date',
            'status' => 'nullable|string',
        ]);

        if ($request->category_id === 'custom') {

            if (!$request->filled('custom_category')) {
                return back()
                    ->withErrors([
                        'custom_category' =>
                            'Please enter a custom category.'
                    ])
                    ->withInput();
            }

        } elseif ($request->filled('category_id')) {

            $request->validate([
                'category_id' => 'exists:categories,id',
            ]);

        } else {

            return back()
                ->withErrors([
                    'category_id' =>
                        'Please select a category or enter a custom category.'
                ])
                ->withInput();
        }

        if ($request->location_id === 'custom') {

            if (!$request->filled('custom_location')) {
                return back()
                    ->withErrors([
                        'custom_location' =>
                            'Please enter a custom location.'
                    ])
                    ->withInput();
            }

        } elseif ($request->filled('location_id')) {

            $request->validate([
                'location_id' => 'exists:locations,id',
            ]);

        } else {

            return back()
                ->withErrors([
                    'location_id' =>
                        'Please select a location or enter a custom location.'
                ])
                ->withInput();
        }

        if (
            $request->filled('compensation_offer') &&
            $request->category_id !== 'custom' &&
            $request->filled('category_id')
        ) {

            $rule = CompensationRule::where(
                'category_id',
                $request->category_id
            )->first();

            if ($rule) {

                $amount = (float) $request->compensation_offer;

                if (
                    $amount < (float) $rule->min_amount ||
                    $amount > (float) $rule->max_amount
                ) {
                    return back()
                        ->withErrors([
                            'compensation_offer' =>
                                'The compensation offer must be between ₱' .
                                number_format($rule->min_amount, 2) .
                                ' and ₱' .
                                number_format($rule->max_amount, 2) .
                                ' for this category.'
                        ])
                        ->withInput();
                }
            }
        }

        $imagePath = null;

        if ($request->hasFile('image')) {

            $imagePath = $request
                ->file('image')
                ->store('lost-items', 'public');
        }

        $lostItem = LostItem::create([

            'user_id' => auth()->id(),

            'category_id' =>
                $request->category_id === 'custom'
                    ? null
                    : $request->category_id,

            'custom_category' =>
                $request->category_id === 'custom'
                    ? $request->custom_category
                    : null,

            'location_id' =>
                $request->location_id === 'custom'
                    ? null
                    : $request->location_id,

            'custom_location' =>
                $request->location_id === 'custom'
                    ? $request->custom_location
                    : null,

            'item_name' => $request->item_name,

            'description' => $request->description,

            'compensation_offer' =>
                $request->filled('compensation_offer')
                    ? $request->compensation_offer
                    : null,

            'image' => $imagePath,

            'lost_date' => $request->lost_date,

            'status' => $request->status ?? 'reported',
        ]);

        ActivityLog::record(
            'Report Lost Item',
            'Reported lost item: ' .
            $lostItem->item_name .
            ($lostItem->compensation_offer !== null
                ? ' with a maximum compensation offer of ₱' .
                    number_format(
                        (float) $lostItem->compensation_offer,
                        2
                    ) . '.'
                : ' with no compensation offer.')
        );

        if (auth()->user()->role === 'admin') {

            return redirect('/admin/report-lost')
                ->with(
                    'success',
                    'Lost item reported successfully.'
                );
        }

        if (auth()->user()->role === 'faculty') {

            return redirect('/faculty/report-lost')
                ->with(
                    'success',
                    'Lost item reported successfully.'
                );
        }

        return redirect()
            ->route('student.my-reports')
            ->with(
                'success',
                'Lost item reported successfully.'
            );
    }

    public function update(Request $request, $id)
    {
        $lostItem = LostItem::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        $request->validate([
            'category_id' => 'nullable',
            'custom_category' => 'nullable|string|max:255',
            'location_id' => 'nullable',
            'custom_location' => 'nullable|string|max:255',
            'item_name' => 'required|string',
            'description' => 'required|string',
            'compensation_offer' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'lost_date' => 'required|date',
        ]);

        if ($request->category_id === 'custom') {

            if (!$request->filled('custom_category')) {
                return back()
                    ->withErrors([
                        'custom_category' =>
                            'Please enter a custom category.'
                    ])
                    ->withInput();
            }

        } elseif ($request->filled('category_id')) {

            $request->validate([
                'category_id' => 'exists:categories,id',
            ]);

        } else {

            return back()
                ->withErrors([
                    'category_id' =>
                        'Please select a category or enter a custom category.'
                ])
                ->withInput();
        }

        if ($request->location_id === 'custom') {

            if (!$request->filled('custom_location')) {
                return back()
                    ->withErrors([
                        'custom_location' =>
                            'Please enter a custom location.'
                    ])
                    ->withInput();
            }

        } elseif ($request->filled('location_id')) {

            $request->validate([
                'location_id' => 'exists:locations,id',
            ]);

        } else {

            return back()
                ->withErrors([
                    'location_id' =>
                        'Please select a location or enter a custom location.'
                ])
                ->withInput();
        }

        if (
            $request->filled('compensation_offer') &&
            $request->category_id !== 'custom' &&
            $request->filled('category_id')
        ) {

            $rule = CompensationRule::where(
                'category_id',
                $request->category_id
            )->first();

            if ($rule) {

                $amount = (float) $request->compensation_offer;

                if (
                    $amount < (float) $rule->min_amount ||
                    $amount > (float) $rule->max_amount
                ) {
                    return back()
                        ->withErrors([
                            'compensation_offer' =>
                                'The compensation offer must be between ₱' .
                                number_format($rule->min_amount, 2) .
                                ' and ₱' .
                                number_format($rule->max_amount, 2) .
                                ' for this category.'
                        ])
                        ->withInput();
                }
            }
        }

        $imagePath = $lostItem->image;

        if ($request->hasFile('image')) {

            if ($lostItem->image) {
                Storage::disk('public')
                    ->delete($lostItem->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('lost-items', 'public');
        }

        $lostItem->update([

            'category_id' =>
                $request->category_id === 'custom'
                    ? null
                    : $request->category_id,

            'custom_category' =>
                $request->category_id === 'custom'
                    ? $request->custom_category
                    : null,

            'location_id' =>
                $request->location_id === 'custom'
                    ? null
                    : $request->location_id,

            'custom_location' =>
                $request->location_id === 'custom'
                    ? $request->custom_location
                    : null,

            'item_name' => $request->item_name,

            'description' => $request->description,

            'compensation_offer' =>
                $request->filled('compensation_offer')
                    ? $request->compensation_offer
                    : null,

            'image' => $imagePath,

            'lost_date' => $request->lost_date,
        ]);

        ActivityLog::record(
            'Update Lost Item',
            'Updated lost item: ' .
            $lostItem->item_name .
            ($lostItem->compensation_offer !== null
                ? ' with a maximum compensation offer of ₱' .
                    number_format(
                        (float) $lostItem->compensation_offer,
                        2
                    ) . '.'
                : ' with no compensation offer.')
        );

        return redirect()
            ->route(
                'student.report-details',
                $lostItem->id
            )
            ->with(
                'success',
                'Lost item report updated successfully.'
            );
    }

    public function destroy($id)
    {
        $lostItem = LostItem::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        if ($lostItem->image) {
            Storage::disk('public')
                ->delete($lostItem->image);
        }

        ActivityLog::record(
            'Delete Lost Item',
            'Deleted lost item: ' .
            $lostItem->item_name
        );

        $lostItem->delete();

        return redirect()
            ->route('student.my-reports')
            ->with(
                'success',
                'Lost item report deleted successfully.'
            );
    }

    public function myReports()
    {
        $lostItems = LostItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $foundItems = \App\Models\FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'student.my-reports',
            compact(
                'lostItems',
                'foundItems'
            )
        );
    }

    public function adminMyReports()
    {
        $lostItems = LostItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $foundItems = \App\Models\FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'admin.my-reports',
            compact(
                'lostItems',
                'foundItems'
            )
        );
    }

    public function matches($id)
    {
        $lostItem = LostItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $foundItems = \App\Models\FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', '!=', auth()->id())
            ->where('status', 'approved')
            ->get();

        $matches = $foundItems
            ->map(function ($foundItem) use ($lostItem) {

                $score = 0;

                if (
                    $lostItem->category_id &&
                    $foundItem->category_id &&
                    $lostItem->category_id ==
                    $foundItem->category_id
                ) {
                    $score += 40;
                }

                if (
                    $lostItem->location_id &&
                    $foundItem->location_id &&
                    $lostItem->location_id ==
                    $foundItem->location_id
                ) {
                    $score += 30;
                }

                similar_text(
                    strtolower($lostItem->item_name),
                    strtolower($foundItem->item_name),
                    $nameSimilarity
                );

                $score += round(
                    $nameSimilarity * 0.2
                );

                similar_text(
                    strtolower($lostItem->description),
                    strtolower($foundItem->description),
                    $descriptionSimilarity
                );

                $score += round(
                    $descriptionSimilarity * 0.1
                );

                $foundItem->match_score = min(
                    $score,
                    100
                );

                return $foundItem;

            })
            ->filter(function ($foundItem) {

                return $foundItem->match_score >= 40;

            })
            ->sortByDesc('match_score')
            ->values();

        return view(
            'student.matches',
            compact(
                'lostItem',
                'matches'
            )
        );
    }

    public function facultyLostItems()
    {
        $lostItems = LostItem::with([
            'user',
            'category',
            'location'
        ])
            ->latest()
            ->get();

        return view(
            'faculty.lost-items',
            compact('lostItems')
        );
    }

    public function adminLostItems()
    {
        $lostItems = LostItem::with([
            'user',
            'category',
            'location'
        ])
            ->latest()
            ->get();

        return view(
            'admin.lost-items',
            compact('lostItems')
        );
    }

    public function adminLostItemDetails($id)
    {
        $lostItem = LostItem::with([
            'user',
            'category',
            'location'
        ])->findOrFail($id);

        return view(
            'admin.lost-item-details',
            compact('lostItem')
        );
    }

    public function adminDeleteLostItem($id)
    {
        $lostItem = LostItem::findOrFail($id);

        if ($lostItem->image) {
            Storage::disk('public')
                ->delete($lostItem->image);
        }

        ActivityLog::record(
            'Delete Lost Item',
            'Admin deleted lost item: ' .
            $lostItem->item_name
        );

        $lostItem->delete();

        return redirect()
            ->route('admin.lost-items')
            ->with(
                'success',
                'Lost item report deleted successfully.'
            );
    }
}