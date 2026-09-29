<?php

namespace App\Http\Controllers;

use App\Models\Compensation;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class CompensationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | API: Get All Compensations
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return response()->json(
            Compensation::with([
                'claim',
                'finder',
                'claimant',
                'confirmer'
            ])->get()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | API: Create Compensation
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'claim_id' => 'required|exists:claims,id',
            'finder_id' => 'required|exists:users,id',
            'claimant_id' => 'required|exists:users,id',
            'confirmed_by' => 'nullable|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|string',
            'paid_at' => 'nullable|date',
        ]);

        $compensation = Compensation::create([
            'claim_id' => $request->claim_id,
            'finder_id' => $request->finder_id,
            'claimant_id' => $request->claimant_id,
            'confirmed_by' => $request->confirmed_by,
            'amount' => $request->amount,
            'status' => $request->status ?? 'pending',
            'paid_at' => $request->paid_at,
        ]);

        return response()->json($compensation);
    }

    /*
    |--------------------------------------------------------------------------
    | API: Get One Compensation
    |--------------------------------------------------------------------------
    */

    public function show(string $id)
    {
        $compensation = Compensation::with([
            'claim',
            'finder',
            'claimant',
            'confirmer'
        ])->find($id);

        if (!$compensation) {
            return response()->json([
                'message' => 'Compensation not found'
            ], 404);
        }

        return response()->json($compensation);
    }

    /*
    |--------------------------------------------------------------------------
    | API: Update Compensation
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $compensation = Compensation::find($id);

        if (!$compensation) {
            return response()->json([
                'message' => 'Compensation not found'
            ], 404);
        }

        $request->validate([
            'claim_id' => 'required|exists:claims,id',
            'finder_id' => 'required|exists:users,id',
            'claimant_id' => 'required|exists:users,id',
            'confirmed_by' => 'nullable|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'nullable|string',
            'paid_at' => 'nullable|date',
        ]);

        $compensation->update([
            'claim_id' => $request->claim_id,
            'finder_id' => $request->finder_id,
            'claimant_id' => $request->claimant_id,
            'confirmed_by' => $request->confirmed_by,
            'amount' => $request->amount,
            'status' => $request->status,
            'paid_at' => $request->paid_at,
        ]);

        return response()->json($compensation);
    }

    /*
    |--------------------------------------------------------------------------
    | FACULTY: Manage Compensations
    |--------------------------------------------------------------------------
    */

    public function manageCompensations()
    {
        $compensations = Compensation::with([
            'claim.foundItem',
            'finder',
            'claimant',
            'confirmer'
        ])
            ->latest()
            ->get();

        return view(
            'faculty.compensations',
            compact('compensations')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | FACULTY / ADMIN: Mark Compensation As Paid
    |--------------------------------------------------------------------------
    */

    public function markAsPaid($id)
    {
        $compensation = Compensation::with([
            'finder',
            'claimant'
        ])->find($id);

        if (!$compensation) {
            return back()->withErrors([
                'compensation' => 'Compensation not found.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Payment
        |--------------------------------------------------------------------------
        */

        if ($compensation->status === 'paid') {
            return back()->withErrors([
                'compensation' =>
                    'This compensation has already been marked as paid.'
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Mark Compensation As Paid
        |--------------------------------------------------------------------------
        */

        $compensation->update([
            'status' => 'paid',
            'confirmed_by' => auth()->id(),
            'paid_at' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Notify Finder
        |--------------------------------------------------------------------------
        */

        \App\Models\Notification::create([
            'user_id' => $compensation->finder_id,

            'title' => 'Compensation Paid',

            'message' =>
                'Your compensation of ₱' .
                number_format($compensation->amount, 2) .
                ' for the claimed item has been marked as paid.',

            'type' => 'compensation',

            'is_read' => false,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Activity Log
        |--------------------------------------------------------------------------
        */

        ActivityLog::record(
            'Mark Compensation Paid',
            'Marked compensation #' .
            $compensation->id .
            ' of ₱' .
            number_format($compensation->amount, 2) .
            ' as paid.'
        );

        return back()->with(
            'success',
            'Compensation marked as paid successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | API: Delete Compensation
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        $compensation = Compensation::find($id);

        if (!$compensation) {
            return response()->json([
                'message' => 'Compensation not found'
            ], 404);
        }

        $compensation->delete();

        return response()->json([
            'message' => 'Compensation deleted successfully'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Manage All Compensations
    |--------------------------------------------------------------------------
    */

    public function adminCompensations()
    {
        $compensations = Compensation::with([
            'claim.foundItem.category',
            'claim.foundItem.location',
            'finder',
            'claimant',
            'confirmer'
        ])
            ->latest()
            ->get();

        return view(
            'admin.compensations',
            compact('compensations')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Compensation Details
    |--------------------------------------------------------------------------
    */

    public function adminCompensationDetails($id)
    {
        $compensation = Compensation::with([
            'claim.foundItem.category',
            'claim.foundItem.location',
            'finder',
            'claimant',
            'confirmer'
        ])->findOrFail($id);

        return view(
            'admin.compensation-details',
            compact('compensation')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN: Delete Compensation
    |--------------------------------------------------------------------------
    */

    public function adminDeleteCompensation($id)
    {
        $compensation = Compensation::with([
            'claim',
            'finder',
            'claimant'
        ])->findOrFail($id);

        ActivityLog::record(
            'Delete Compensation',
            'Admin deleted compensation #' .
            $compensation->id .
            ' of ₱' .
            number_format($compensation->amount, 2) .
            '.'
        );

        $compensation->delete();

        return redirect()
            ->route('admin.compensations')
            ->with(
                'success',
                'Compensation record deleted successfully.'
            );
    }
}