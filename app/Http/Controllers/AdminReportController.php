<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LostItem;
use App\Models\FoundItem;
use App\Models\Claim;
use App\Models\Compensation;

class AdminReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalLostItems = LostItem::count();

        $totalFoundItems = FoundItem::count();

        $totalClaims = Claim::count();

        $totalCompensations = Compensation::count();

        $paidCompensations = Compensation::where('status', 'paid')->count();

        $unpaidCompensations = Compensation::whereIn('status', [
            'unpaid',
            'pending'
        ])->count();

        $totalCompensationAmount = Compensation::sum('amount');

        $paidCompensationAmount = Compensation::where('status', 'paid')
            ->sum('amount');

        $pendingClaims = Claim::where('status', 'pending')->count();

        $approvedClaims = Claim::where('status', 'approved')->count();

        $rejectedClaims = Claim::where('status', 'rejected')->count();

        $lostReported = LostItem::where('status', 'reported')->count();

        $lostClaimed = LostItem::where('status', 'claimed')->count();

        $lostResolved = LostItem::where('status', 'resolved')->count();

        $foundAwaitingSurrender = FoundItem::where(
            'status',
            'awaiting_surrender'
        )->count();

        $foundReceived = FoundItem::where(
            'status',
            'received'
        )->count();

        $foundApproved = FoundItem::where(
            'status',
            'approved'
        )->count();

        $foundClaimed = FoundItem::where(
            'status',
            'claimed'
        )->count();

        $foundRejected = FoundItem::where(
            'status',
            'rejected'
        )->count();

        return view('admin.reports', compact(
            'totalUsers',
            'totalLostItems',
            'totalFoundItems',
            'totalClaims',
            'totalCompensations',
            'paidCompensations',
            'unpaidCompensations',
            'totalCompensationAmount',
            'paidCompensationAmount',
            'pendingClaims',
            'approvedClaims',
            'rejectedClaims',
            'lostReported',
            'lostClaimed',
            'lostResolved',
            'foundAwaitingSurrender',
            'foundReceived',
            'foundApproved',
            'foundClaimed',
            'foundRejected'
        ));
    }
}