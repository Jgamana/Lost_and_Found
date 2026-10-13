<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\CompensationRule;
use App\Models\Category;
use App\Models\Location;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoundItemController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return response()->json(
            FoundItem::with([
                'user',
                'category',
                'location',
                'receiver'
            ])->get()
        );
    }

    public function update(Request $request, string $id)
    {
        $foundItem = FoundItem::find($id);

        if (!$foundItem) {
            return response()->json([
                'message' => 'Found item not found'
            ], 404);
        }

        // Support custom locations in the API.
        if ($request->input('location_id') === 'custom') {
            $request->merge([
                'location_id' => null,
            ]);
        }

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'location_id' => 'sometimes|nullable|required_without:custom_location|exists:locations,id',
            'custom_location' => 'sometimes|nullable|required_without:location_id|string|max:255',
            'received_by' => 'sometimes|nullable|exists:users,id',
            'item_name' => 'sometimes|required|string',
            'description' => 'sometimes|required|string',
            'found_date' => 'sometimes|required|date|before_or_equal:today',
            'status' => 'sometimes|required|string',
        ]);

        if (array_key_exists('location_id', $validated)) {
            $validated['custom_location'] = !empty($validated['custom_location'])
                ? trim($validated['custom_location'])
                : null;
        } elseif (array_key_exists('custom_location', $validated)) {
            $validated['custom_location'] = !empty($validated['custom_location'])
                ? trim($validated['custom_location'])
                : null;

            if ($validated['custom_location'] !== null) {
                $validated['location_id'] = null;
            }
        }

        $foundItem->update($validated);

        return response()->json(
            $foundItem->load([
                'user',
                'category',
                'location',
                'receiver'
            ])
        );
    }

    public function destroy(string $id)
    {
        $foundItem = FoundItem::find($id);

        if (!$foundItem) {
            return response()->json([
                'message' => 'Found item not found'
            ], 404);
        }

        if ($foundItem->image) {
            Storage::disk('public')->delete($foundItem->image);
        }

        $foundItem->delete();

        return response()->json([
            'message' => 'Found item deleted successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Student / Faculty / Admin Found Item Reporting
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        // Convert the custom dropdown option into a nullable location ID.
        if ($request->input('location_id') === 'custom') {
            $request->merge([
                'location_id' => null,
            ]);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'nullable|required_without:custom_location|exists:locations,id',
            'custom_location' => 'nullable|required_without:location_id|string|max:255',
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'found_date' => 'required|date|before_or_equal:today',
        ]);

        $suggestedCompensation = null;

        // Only students must suggest compensation when reporting found items.
        if (auth()->user()->role === 'student') {
            $compensationRule = CompensationRule::where(
                'category_id',
                $request->category_id
            )->first();

            if (!$compensationRule) {
                return back()
                    ->withErrors([
                        'suggested_compensation' =>
                            'No compensation rule has been set for this category.'
                    ])
                    ->withInput();
            }

            $request->validate([
                'suggested_compensation' => [
                    'required',
                    'numeric',
                    'min:' . $compensationRule->min_amount,
                    'max:' . $compensationRule->max_amount,
                ],
            ]);

            $suggestedCompensation = $request->suggested_compensation;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request
                ->file('image')
                ->store('found-items', 'public');
        }

        /*
        |--------------------------------------------------------------------------
        | Determine Status
        |--------------------------------------------------------------------------
        */

        $status = 'awaiting_surrender';

        if (auth()->user()->role === 'admin') {
            $status = 'approved';
        }

        /*
        |--------------------------------------------------------------------------
        | Create Found Item
        |--------------------------------------------------------------------------
        */

        $customLocation = $request->filled('custom_location')
            ? trim($request->input('custom_location'))
            : null;

        $foundItem = FoundItem::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'location_id' => $customLocation
                ? null
                : $request->location_id,
            'custom_location' => $customLocation,
            'received_by' => null,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'suggested_compensation' => $suggestedCompensation,
            'image' => $imagePath,
            'found_date' => $request->found_date,
            'status' => $status,
        ]);

        ActivityLog::record(
            'Report Found Item',
            'Reported found item: ' . $foundItem->item_name
        );

        /*
        |--------------------------------------------------------------------------
        | Redirect Based On Role
        |--------------------------------------------------------------------------
        */

        if (auth()->user()->role === 'admin') {
            return redirect('/admin/report-found')
                ->with(
                    'success',
                    'Found item reported successfully. The item has been approved automatically.'
                );
        }

        if (auth()->user()->role === 'faculty') {
            return redirect('/faculty/report-found')
                ->with(
                    'success',
                    'Found item reported successfully. Please surrender the item in the SAS Office.'
                );
        }

        return redirect('/student/report-found')
            ->with(
                'success',
                'Found item reported successfully. Please surrender the item in the SAS Office.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Student My Found Reports
    |--------------------------------------------------------------------------
    */

    public function myReports()
    {
        $foundItems = FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'student.my-found-reports',
            compact('foundItems')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student Edit Found Report
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $foundItem = FoundItem::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        $categories = Category::all();
        $locations = Location::all();

        return view(
            'student.edit-found-report',
            compact(
                'foundItem',
                'categories',
                'locations'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student Found Report Details
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $foundItem = FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view(
            'student.found-report-details',
            compact('foundItem')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student Update Found Report
    |--------------------------------------------------------------------------
    */

    public function updateWeb(Request $request, $id)
    {
        $foundItem = FoundItem::where(
            'user_id',
            auth()->id()
        )->findOrFail($id);

        if ($request->input('location_id') === 'custom') {
            $request->merge([
                'location_id' => null,
            ]);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'nullable|required_without:custom_location|exists:locations,id',
            'custom_location' => 'nullable|required_without:location_id|string|max:255',
            'item_name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'found_date' => 'required|date|before_or_equal:today',
        ]);

        $imagePath = $foundItem->image;

        if ($request->hasFile('image')) {
            if ($foundItem->image) {
                Storage::disk('public')->delete($foundItem->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('found-items', 'public');
        }

        $customLocation = $request->filled('custom_location')
            ? trim($request->input('custom_location'))
            : null;

        $foundItem->update([
            'category_id' => $request->category_id,
            'location_id' => $customLocation
                ? null
                : $request->location_id,
            'custom_location' => $customLocation,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'image' => $imagePath,
            'found_date' => $request->found_date,
        ]);

        ActivityLog::record(
            'Update Found Item',
            'Updated found item: ' . $foundItem->item_name
        );

        return redirect()
            ->route(
                'student.found-report-details',
                $foundItem->id
            )
            ->with(
                'success',
                'Found item report updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Student Available Found Items
    |--------------------------------------------------------------------------
    */

    public function availableItems(Request $request)
    {
        $query = $request->input('q');

        $foundItems = FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', '!=', auth()->id())
            ->where('status', 'approved')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($search) use ($query) {
                    $search->where(
                        'item_name',
                        'like',
                        "%{$query}%"
                    )
                    ->orWhere(
                        'description',
                        'like',
                        "%{$query}%"
                    )
                    ->orWhereHas('category', function ($category) use ($query) {
                        $category->where(
                            'name',
                            'like',
                            "%{$query}%"
                        );
                    })
                    ->orWhereHas('location', function ($location) use ($query) {
                        $location->where(
                            'name',
                            'like',
                            "%{$query}%"
                        );
                    })
                    ->orWhere(
                        'custom_location',
                        'like',
                        "%{$query}%"
                    );
                });
            })
            ->latest()
            ->get();

        return view(
            'student.found-items',
            compact('foundItems')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty Browse Found Items
    |--------------------------------------------------------------------------
    */

    public function facultyFoundItems()
    {
        $foundItems = FoundItem::with([
            'user',
            'category',
            'location',
            'receiver'
        ])
            ->latest()
            ->get();

        return view(
            'faculty.browse-found-items',
            compact('foundItems')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty / Admin Verify Found Items
    |--------------------------------------------------------------------------
    */

    public function manageFoundItems()
    {
        $foundItems = FoundItem::with([
            'user',
            'category',
            'location',
            'receiver'
        ])
            ->whereIn('status', [
                'awaiting_surrender',
                'received'
            ])
            ->latest()
            ->get();

        return view(
            'faculty.found-items',
            compact('foundItems')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty / Admin Receive Found Item
    |--------------------------------------------------------------------------
    */

    public function receiveFoundItem($id)
    {
        $foundItem = FoundItem::findOrFail($id);

        if ($foundItem->user_id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot receive your own found item.'
            );
        }

        if ($foundItem->status !== 'awaiting_surrender') {
            return back()->with(
                'error',
                'This found item is not awaiting surrender.'
            );
        }

        $foundItem->update([
            'received_by' => auth()->id(),
            'status' => 'received',
        ]);

        ActivityLog::record(
            'Receive Found Item',
            'Received found item: ' . $foundItem->item_name
        );

        return back()->with(
            'success',
            'Found item received successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty / Admin Approve Found Item
    |--------------------------------------------------------------------------
    */

    public function approveFoundItem($id)
    {
        $foundItem = FoundItem::findOrFail($id);

        if ($foundItem->user_id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot approve your own found item.'
            );
        }

        if ($foundItem->status !== 'received') {
            return back()->with(
                'error',
                'This item must be received before it can be approved.'
            );
        }

        $foundItem->update([
            'status' => 'approved',
        ]);

        ActivityLog::record(
            'Approve Found Item',
            'Approved found item: ' . $foundItem->item_name
        );

        return back()->with(
            'success',
            'Found item approved successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty / Admin Reject Found Item
    |--------------------------------------------------------------------------
    */

    public function rejectFoundItem($id)
    {
        $foundItem = FoundItem::findOrFail($id);

        if ($foundItem->user_id === auth()->id()) {
            return back()->with(
                'error',
                'You cannot reject your own found item.'
            );
        }

        if ($foundItem->status !== 'received') {
            return back()->with(
                'error',
                'This item must be received before it can be rejected.'
            );
        }

        $foundItem->update([
            'status' => 'rejected',
        ]);

        ActivityLog::record(
            'Reject Found Item',
            'Rejected found item: ' . $foundItem->item_name
        );

        return back()->with(
            'success',
            'Found item rejected successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Found Items
    |--------------------------------------------------------------------------
    */

    public function adminFoundItems()
    {
        $foundItems = FoundItem::with([
            'user',
            'category',
            'location',
            'receiver'
        ])
            ->latest()
            ->get();

        return view(
            'admin.found-items',
            compact('foundItems')
        );
    }

    public function adminFoundItemDetails($id)
    {
        $foundItem = FoundItem::with([
            'user',
            'category',
            'location',
            'receiver'
        ])->findOrFail($id);

        return view(
            'admin.found-item-details',
            compact('foundItem')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Delete Found Item
    |--------------------------------------------------------------------------
    */

    public function adminDeleteFoundItem($id)
    {
        $foundItem = FoundItem::findOrFail($id);

        if ($foundItem->image) {
            Storage::disk('public')->delete($foundItem->image);
        }

        ActivityLog::record(
            'Delete Found Item',
            'Deleted found item: ' . $foundItem->item_name
        );

        $foundItem->delete();

        return redirect()
            ->route('admin.found-items')
            ->with(
                'success',
                'Found item report deleted successfully.'
            );
    }
}
