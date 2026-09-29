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

        $foundItem->update([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
            'received_by' => $request->received_by,
            'item_name' => $request->item_name,
            'description' => $request->description,
            'found_date' => $request->found_date,
            'status' => $request->status,
        ]);

        return response()->json($foundItem);
    }

    public function destroy(string $id)
    {
        $foundItem = FoundItem::find($id);

        if (!$foundItem) {
            return response()->json([
                'message' => 'Found item not found'
            ], 404);
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
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'item_name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'found_date' => 'required|date',
        ]);

        $suggestedCompensation = null;

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

        $foundItem = FoundItem::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
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
                    'Found item reported successfully. Please surrender the item to Faculty or Admin for verification.'
                );
        }

        return redirect('/student/report-found')
            ->with(
                'success',
                'Found item reported successfully. Please surrender the item to Faculty or Admin for verification.'
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

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'item_name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'found_date' => 'required|date',
        ]);

        $imagePath = $foundItem->image;

        if ($request->hasFile('image')) {

            if ($foundItem->image) {
                Storage::disk('public')
                    ->delete($foundItem->image);
            }

            $imagePath = $request
                ->file('image')
                ->store('found-items', 'public');
        }

        $foundItem->update([
            'category_id' => $request->category_id,
            'location_id' => $request->location_id,
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

                    });

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
            Storage::disk('public')
                ->delete($foundItem->image);
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