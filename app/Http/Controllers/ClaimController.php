<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Notification;
use App\Models\Compensation;
use App\Models\CompensationRule;
use App\Models\FoundItem;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API - Display All Claims
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return response()->json(
            Claim::with([
                'foundItem',
                'claimant',
                'verifier'
            ])->get()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student - My Claims
    |--------------------------------------------------------------------------
    */

    public function myClaims()
    {
        $claims = Claim::with([
            'foundItem',
            'foundItem.category',
            'foundItem.location'
        ])
            ->where('claimant_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'student.my-claims',
            compact('claims')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty/Admin - Manage Claims
    |--------------------------------------------------------------------------
    */

    public function manageClaims()
    {
        $claims = Claim::with([
            'foundItem',
            'foundItem.category',
            'foundItem.location',
            'claimant'
        ])
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view(
            'faculty.claims',
            compact('claims')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty/Admin - Set Release Schedule
    |--------------------------------------------------------------------------
    */

    public function schedule(Request $request, $id)
    {
        $request->validate([
            'release_date' => 'required|date',
            'release_time' => 'required',
            'release_location' => 'required|string|max:255',
        ]);

        $claim = Claim::with([
            'foundItem',
            'claimant'
        ])->findOrFail($id);

        if ($claim->status !== 'pending') {
            return back()->withErrors([
                'claim' => 'This claim has already been processed.'
            ]);
        }

        $claim->update([
            'release_date' => $request->release_date,
            'release_time' => $request->release_time,
            'release_location' => $request->release_location,
        ]);

        Notification::create([
            'user_id' => $claim->claimant_id,

            'title' => 'Claim Release Scheduled',

            'message' =>
                'Your claim for "' .
                ($claim->foundItem->item_name ?? 'the found item') .
                '" has been scheduled for release on ' .
                date(
                    'F d, Y',
                    strtotime($request->release_date)
                ) .
                ' at ' .
                date(
                    'h:i A',
                    strtotime($request->release_time)
                ) .
                ' at ' .
                $request->release_location .
                '. Please bring the necessary proof for physical verification.',

            'type' => 'claim',

            'is_read' => false,
        ]);

        ActivityLog::record(
            'Schedule Claim Release',
            'Scheduled release for claim #' . $claim->id .
            ' for "' .
            ($claim->foundItem->item_name ?? 'the found item') .
            '" on ' .
            date('F d, Y', strtotime($request->release_date)) .
            ' at ' .
            date('h:i A', strtotime($request->release_time)) .
            ' at ' .
            $request->release_location
        );

        return back()->with(
            'success',
            'Release schedule set successfully. The student has been notified.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty/Admin - Physical Release & Approve Claim
    |--------------------------------------------------------------------------
    */

    public function approve($id)
    {
        $claim = Claim::with([
            'foundItem',
            'claimant'
        ])->findOrFail($id);

        if ($claim->status !== 'pending') {
            return back()->withErrors([
                'claim' => 'This claim has already been processed.'
            ]);
        }

        if (
            !$claim->release_date ||
            !$claim->release_time ||
            !$claim->release_location
        ) {
            return back()->withErrors([
                'claim' =>
                    'Please set a release schedule before approving this claim.'
            ]);
        }

        if (!$claim->foundItem) {
            return back()->withErrors([
                'claim' =>
                    'The found item associated with this claim no longer exists.'
            ]);
        }

        $compensationRule = CompensationRule::where(
            'category_id',
            $claim->foundItem->category_id
        )->first();

        $compensationAmount =
            $claim->foundItem->suggested_compensation;

        if (!$compensationRule) {
            return back()->withErrors([
                'claim' =>
                    'No compensation rule has been set for this item category.'
            ]);
        }

        if ($compensationAmount === null) {
            return back()->withErrors([
                'claim' =>
                    'No compensation amount was provided for this found item.'
            ]);
        }

        if (
            $compensationAmount < $compensationRule->min_amount ||
            $compensationAmount > $compensationRule->max_amount
        ) {
            return back()->withErrors([
                'claim' =>
                    'The compensation amount is outside the allowed range for this category.'
            ]);
        }

        $claim->update([
            'status' => 'approved',
            'verified_by' => auth()->id(),
        ]);

        $claim->foundItem->update([
            'status' => 'claimed',
        ]);

        $compensation = Compensation::firstOrCreate(
            [
                'claim_id' => $claim->id,
            ],
            [
                'finder_id' =>
                    $claim->foundItem->user_id,

                'claimant_id' =>
                    $claim->claimant_id,

                'confirmed_by' => null,

                'amount' =>
                    $compensationAmount,

                'status' => 'unpaid',

                'paid_at' => null,
            ]
        );

        Notification::create([
            'user_id' => $claim->claimant_id,

            'title' => 'Item Claim Approved',

            'message' =>
                'Your claim for "' .
                $claim->foundItem->item_name .
                '" has been approved. ' .
                'Release schedule: ' .
                date(
                    'F d, Y',
                    strtotime($claim->release_date)
                ) .
                ' at ' .
                date(
                    'h:i A',
                    strtotime($claim->release_time)
                ) .
                ' at ' .
                $claim->release_location .
                '.',

            'type' => 'claim',

            'is_read' => false,
        ]);

        Notification::create([
            'user_id' =>
                $claim->foundItem->user_id,

            'title' =>
                'Item Claimed - Compensation Pending',

            'message' =>
                'Your found item "' .
                $claim->foundItem->item_name .
                '" has been claimed. ' .
                'The compensation amount is ₱' .
                number_format(
                    $compensationAmount,
                    2
                ) .
                ' and is currently unpaid.',

            'type' => 'compensation',

            'is_read' => false,
        ]);

        ActivityLog::record(
            'Approve Claim',
            'Approved claim #' . $claim->id .
            ' for "' .
            $claim->foundItem->item_name .
            '". Compensation of ₱' .
            number_format($compensationAmount, 2) .
            ' was created.'
        );

        if (auth()->user()->role === 'admin') {
            return redirect()
                ->route('admin.claims')
                ->with(
                    'success',
                    'Claim approved and compensation created successfully.'
                );
        }

        return redirect()
            ->route('faculty.claims')
            ->with(
                'success',
                'Claim approved and compensation created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Faculty/Admin - Reject Claim
    |--------------------------------------------------------------------------
    */

    public function reject($id)
    {
        $claim = Claim::with([
            'foundItem',
            'claimant'
        ])->findOrFail($id);

        if ($claim->status !== 'pending') {
            return back()->withErrors([
                'claim' => 'This claim has already been processed.'
            ]);
        }

        $claim->update([
            'status' => 'rejected',
            'verified_by' => auth()->id(),
        ]);

        Notification::create([
            'user_id' => $claim->claimant_id,

            'title' => 'Claim Rejected',

            'message' =>
                'Your claim for "' .
                ($claim->foundItem->item_name ?? 'the found item') .
                '" has been rejected.',

            'type' => 'claim',

            'is_read' => false,
        ]);

        ActivityLog::record(
            'Reject Claim',
            'Rejected claim #' . $claim->id .
            ' for "' .
            ($claim->foundItem->item_name ?? 'the found item') .
            '"'
        );

        return back()->with(
            'success',
            'Claim rejected successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student - Show Claim Form
    |--------------------------------------------------------------------------
    */

    public function create($id)
    {
        $foundItem = FoundItem::with([
            'category',
            'location'
        ])
            ->where('user_id', '!=', auth()->id())
            ->findOrFail($id);

        return view(
            'student.claim-found-item',
            compact('foundItem')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Student - Submit Claim
    |--------------------------------------------------------------------------
    */

    public function storeWeb(Request $request)
    {
        $request->validate([
            'found_item_id' => 'required|exists:found_items,id',
            'proof' => 'required|string',
        ]);

        $foundItem = FoundItem::findOrFail(
            $request->found_item_id
        );

        if ($foundItem->user_id == auth()->id()) {
            return back()
                ->withErrors([
                    'proof' =>
                        'You cannot claim your own found item.'
                ])
                ->withInput();
        }

        $existingClaim = Claim::where(
            'found_item_id',
            $request->found_item_id
        )
            ->where(
                'claimant_id',
                auth()->id()
            )
            ->where(
                'status',
                'pending'
            )
            ->exists();

        if ($existingClaim) {
            return back()
                ->withErrors([
                    'proof' =>
                        'You have already submitted a claim for this item.'
                ])
                ->withInput();
        }

        $claim = Claim::create([
            'found_item_id' =>
                $request->found_item_id,

            'claimant_id' =>
                auth()->id(),

            'verified_by' => null,

            'proof' =>
                $request->proof,

            'status' => 'pending',
        ]);

        Notification::create([
            'user_id' =>
                $foundItem->user_id,

            'title' =>
                'New Claim Submitted',

            'message' =>
                auth()->user()->name .
                ' submitted a claim for your found item: ' .
                $foundItem->item_name,

            'type' => 'claim',

            'is_read' => false,
        ]);

        ActivityLog::record(
            'Submit Claim',
            'Submitted claim #' . $claim->id .
            ' for found item "' .
            $foundItem->item_name .
            '"'
        );

        if (auth()->user()->role === 'faculty') {
    return redirect()
        ->route('faculty.browse-found-items')
        ->with(
            'success',
            'Claim submitted successfully.'
        );
}

return redirect()
    ->route('student.found-items')
    ->with(
        'success',
        'Claim submitted successfully.'
    );
    }

    /*
    |--------------------------------------------------------------------------
    | API - Create Claim
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'found_item_id' =>
                'required|exists:found_items,id',

            'claimant_id' =>
                'required|exists:users,id',

            'verified_by' =>
                'nullable|exists:users,id',

            'proof' =>
                'nullable|string',

            'status' =>
                'nullable|string',
        ]);

        $claim = Claim::create([
            'found_item_id' =>
                $request->found_item_id,

            'claimant_id' =>
                $request->claimant_id,

            'verified_by' =>
                $request->verified_by,

            'proof' =>
                $request->proof,

            'status' =>
                $request->status ?? 'pending',
        ]);

        return response()->json($claim);
    }

    /*
    |--------------------------------------------------------------------------
    | API - Show Claim
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $claim = Claim::with([
            'foundItem',
            'claimant',
            'verifier'
        ])->find($id);

        if (!$claim) {
            return response()->json([
                'message' => 'Claim not found'
            ], 404);
        }

        return response()->json($claim);
    }

    /*
    |--------------------------------------------------------------------------
    | API - Update Claim
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $claim = Claim::find($id);

        if (!$claim) {
            return response()->json([
                'message' => 'Claim not found'
            ], 404);
        }

        $request->validate([
            'found_item_id' =>
                'required|exists:found_items,id',

            'claimant_id' =>
                'required|exists:users,id',

            'verified_by' =>
                'nullable|exists:users,id',

            'proof' =>
                'nullable|string',

            'status' =>
                'nullable|string',
        ]);

        $claim->update([
            'found_item_id' =>
                $request->found_item_id,

            'claimant_id' =>
                $request->claimant_id,

            'verified_by' =>
                $request->verified_by,

            'proof' =>
                $request->proof,

            'status' =>
                $request->status,
        ]);

        return response()->json($claim);
    }

    /*
    |--------------------------------------------------------------------------
    | API - Delete Claim
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $claim = Claim::find($id);

        if (!$claim) {
            return response()->json([
                'message' => 'Claim not found'
            ], 404);
        }

        $claim->delete();

        return response()->json([
            'message' =>
                'Claim deleted successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Admin - Manage Claims
    |--------------------------------------------------------------------------
    */

    public function adminClaims()
    {
        $claims = Claim::with([
            'foundItem',
            'foundItem.category',
            'foundItem.location',
            'claimant',
            'verifier'
        ])
            ->latest()
            ->get();

        return view(
            'admin.claims',
            compact('claims')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Admin - Claim Details
    |--------------------------------------------------------------------------
    */

    public function adminClaimDetails($id)
    {
        $claim = Claim::with([
            'foundItem',
            'foundItem.category',
            'foundItem.location',
            'claimant',
            'verifier',
            'compensation'
        ])->findOrFail($id);

        return view(
            'admin.claim-details',
            compact('claim')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Admin - Delete Claim
    |--------------------------------------------------------------------------
    */

    public function adminDeleteClaim($id)
    {
        $claim = Claim::with('foundItem')->findOrFail($id);

        ActivityLog::record(
            'Delete Claim',
            'Admin deleted claim #' . $claim->id .
            ' for "' .
            ($claim->foundItem->item_name ?? 'the found item') .
            '"'
        );

        $claim->delete();

        return redirect()
            ->route('admin.claims')
            ->with(
                'success',
                'Claim deleted successfully.'
            );
    }
}