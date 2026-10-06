<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\LostItemController;
use App\Http\Controllers\FoundItemController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompensationController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\Auth\EmailVerificationController;

/*
|--------------------------------------------------------------------------
| General Routes
|--------------------------------------------------------------------------
*/

Route::get('/lost-found', function () {

    if (!auth()->check()) {
        return view('welcome');
    }

    return match (auth()->user()->role) {
        'student' => redirect()->route('student.dashboard'),
        'faculty' => redirect()->route('faculty.dashboard'),
        'admin' => redirect()->route('admin.dashboard'),
        default => redirect()->route('landing'),
    };

})->name('landing');

Route::get('/verify-email', [
    EmailVerificationController::class,
    'show'
])->name('verification.show');

Route::post('/verify-email', [
    EmailVerificationController::class,
    'verify'
])->name('verification.verify');

Route::post('/verify-email/resend', [
    EmailVerificationController::class,
    'resend'
])->name('verification.resend');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'prevent.back'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/profile',
        [UserController::class, 'profile']
    )->name('profile');

    Route::put(
        '/profile',
        [UserController::class, 'updateProfile']
    )->name('profile.update');

    Route::put(
        '/profile/password',
        [UserController::class, 'updatePassword']
    )->name('profile.password');


    /*
    |--------------------------------------------------------------------------
    | Faculty Shared Functions
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:faculty,admin'])->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Report Lost Item
        |--------------------------------------------------------------------------
        */

        Route::get('/faculty/report-lost', function () {

            $categories = \App\Models\Category::all();
            $locations = \App\Models\Location::all();

            return view(
                'faculty.report-lost',
                compact('categories', 'locations')
            );

        })->name('faculty.report-lost');


        Route::post(
            '/faculty/report-lost',
            [LostItemController::class, 'store']
        )->name('faculty.report-lost.store');


        /*
        |--------------------------------------------------------------------------
        | Report Found Item
        |--------------------------------------------------------------------------
        */

        Route::get('/faculty/report-found', function () {

            $categories = \App\Models\Category::all();
            $locations = \App\Models\Location::all();

            return view(
                'faculty.report-found',
                compact('categories', 'locations')
            );

        })->name('faculty.report-found');


        Route::post(
            '/faculty/report-found',
            [FoundItemController::class, 'store']
        );


        /*
        |--------------------------------------------------------------------------
        | Faculty Lost Items
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/faculty/lost-items',
            [LostItemController::class, 'facultyLostItems']
        )->name('faculty.lost-items');


        /*
        |--------------------------------------------------------------------------
        | Faculty Found Items
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/faculty/found-items/browse',
            [FoundItemController::class, 'facultyFoundItems']
        )->name('faculty.browse-found-items');


        /*
        |--------------------------------------------------------------------------
        | Faculty My Reports
        |--------------------------------------------------------------------------
        */

        Route::get('/faculty/my-reports', function () {

            $lostItems = \App\Models\LostItem::where(
                'user_id',
                auth()->id()
            )
                ->latest()
                ->get();

            $foundItems = \App\Models\FoundItem::where(
                'user_id',
                auth()->id()
            )
                ->latest()
                ->get();

            return view(
                'faculty.my-reports',
                compact('lostItems', 'foundItems')
            );

        })->name('faculty.my-reports');


        /*
        |--------------------------------------------------------------------------
        | Faculty Compensation
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/faculty/compensations',
            [
                \App\Http\Controllers\CompensationController::class,
                'manageCompensations'
            ]
        )->name('faculty.compensations');


        Route::post(
            '/faculty/compensations/{id}/paid',
            [
                \App\Http\Controllers\CompensationController::class,
                'markAsPaid'
            ]
        )->name('faculty.compensation-paid');


        /*
        |--------------------------------------------------------------------------
        | Faculty Claims
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/faculty/claim/{id}',
            [ClaimController::class, 'create']
        )->name('faculty.claim-create');

        Route::post(
            '/faculty/claim',
            [ClaimController::class, 'storeWeb']
        )->name('faculty.claim-store');

        Route::get(
            '/faculty/claims',
            [ClaimController::class, 'manageClaims']
        )->name('faculty.claims');


        Route::post(
            '/faculty/claims/{id}/approve',
            [ClaimController::class, 'approve']
        )->name('faculty.claim-approve');


        Route::post(
            '/faculty/claims/{id}/reject',
            [ClaimController::class, 'reject']
        )->name('faculty.claim-reject');


        Route::post(
            '/faculty/claims/{id}/schedule',
            [ClaimController::class, 'schedule']
        )->name('faculty.claim-schedule');


        /*
        |--------------------------------------------------------------------------
        | Faculty Found Item Management
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/faculty/found-items',
            [FoundItemController::class, 'manageFoundItems']
        )->name('faculty.found-items');


        Route::post(
            '/faculty/found-items/{id}/receive',
            [FoundItemController::class, 'receiveFoundItem']
        )->name('faculty.found-item-receive');


        Route::post(
            '/faculty/found-items/{id}/approve',
            [FoundItemController::class, 'approveFoundItem']
        )->name('faculty.found-item-approve');


        Route::post(
            '/faculty/found-items/{id}/reject',
            [FoundItemController::class, 'rejectFoundItem']
        )->name('faculty.found-item-reject');

    });


    /*
    |--------------------------------------------------------------------------
    | Student Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:student'])->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Student Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/student/dashboard', function () {

    /*
    |--------------------------------------------------------------------------
    | Student's Lost Items
    |--------------------------------------------------------------------------
    */

    $lostItems = \App\Models\LostItem::where(
        'user_id',
        auth()->id()
    )
        ->latest()
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Student's Found Items
    |--------------------------------------------------------------------------
    */

    $foundItems = \App\Models\FoundItem::where(
        'user_id',
        auth()->id()
    )
        ->latest()
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Resolved Lost Items
    |--------------------------------------------------------------------------
    */

    $resolvedItems = \App\Models\LostItem::where(
        'user_id',
        auth()->id()
    )
        ->where(
            'status',
            'resolved'
        )
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Active Lost Items
    |--------------------------------------------------------------------------
    */

    $activeLostItems = \App\Models\LostItem::with([
        'category',
        'location'
    ])
        ->where(
            'user_id',
            auth()->id()
        )
        ->where(
            'status',
            '!=',
            'resolved'
        )
        ->latest()
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Approved Found Items
    |--------------------------------------------------------------------------
    |
    | Only approved found items from other users can become
    | possible matches.
    |
    */

    $approvedFoundItems = \App\Models\FoundItem::with([
        'category',
        'location'
    ])
        ->where(
            'user_id',
            '!=',
            auth()->id()
        )
        ->where(
            'status',
            'approved'
        )
        ->get();


    /*
    |--------------------------------------------------------------------------
    | Possible Matches
    |--------------------------------------------------------------------------
    */

    $matchData = $activeLostItems->map(
        function ($lostItem) use ($approvedFoundItems) {

            /*
            |--------------------------------------------------------------
            | Calculate the matching score for every found item
            |--------------------------------------------------------------
            */

            $matchedItems = $approvedFoundItems
                ->map(
                    function ($foundItem) use ($lostItem) {

                        $score = 0;


                        /*
                        |--------------------------------------------------
                        | Category Match = 40 points
                        |--------------------------------------------------
                        */

                        if (
                            $lostItem->category_id &&
                            $foundItem->category_id &&
                            $lostItem->category_id ==
                            $foundItem->category_id
                        ) {

                            $score += 40;

                        }


                        /*
                        |--------------------------------------------------
                        | Location Match = 30 points
                        |--------------------------------------------------
                        */

                        if (
                            $lostItem->location_id &&
                            $foundItem->location_id &&
                            $lostItem->location_id ==
                            $foundItem->location_id
                        ) {

                            $score += 30;

                        }


                        /*
                        |--------------------------------------------------
                        | Item Name Similarity = 20 points
                        |--------------------------------------------------
                        */

                        similar_text(
                            strtolower($lostItem->item_name),
                            strtolower($foundItem->item_name),
                            $nameSimilarity
                        );

                        $score += round(
                            $nameSimilarity * 0.2
                        );


                        /*
                        |--------------------------------------------------
                        | Description Similarity = 10 points
                        |--------------------------------------------------
                        */

                        similar_text(
                            strtolower($lostItem->description ?? ''),
                            strtolower($foundItem->description ?? ''),
                            $descriptionSimilarity
                        );

                        $score += round(
                            $descriptionSimilarity * 0.1
                        );


                        /*
                        |--------------------------------------------------
                        | Maximum score = 100
                        |--------------------------------------------------
                        */

                        $score = min(
                            $score,
                            100
                        );


                        return [
                            'foundItem' => $foundItem,
                            'score' => $score,
                        ];

                    }
                )
                ->filter(
                    function ($match) {

                        /*
                        | Only scores of 40 or higher
                        | are considered possible matches.
                        */

                        return $match['score'] >= 40;

                    }
                )
                ->sortByDesc('score')
                ->values();


            /*
            |--------------------------------------------------------------
            | Return both the count and the actual matched Found Items
            |--------------------------------------------------------------
            */

            return [
                'lostItem' => $lostItem,

                'matchCount' => $matchedItems->count(),

                'matchedItems' => $matchedItems,
            ];

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Student Dashboard
    |--------------------------------------------------------------------------
    */

    return view(
        'student.dashboard',
        compact(
            'lostItems',
            'foundItems',
            'resolvedItems',
            'matchData'
        )
    );

})->name('student.dashboard');

        /*
        |--------------------------------------------------------------------------
        | Student Matches
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/my-reports/{id}/matches',
            [LostItemController::class, 'matches']
        )->name('student.report-matches');


        /*
        |--------------------------------------------------------------------------
        | Student Claims
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/my-claims',
            [ClaimController::class, 'myClaims']
        )->name('student.my-claims');


        /*
        |--------------------------------------------------------------------------
        | Available Found Items
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/found-items',
            [FoundItemController::class, 'availableItems']
        )->name('student.found-items');


        /*
        |--------------------------------------------------------------------------
        | Create Claim
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/claim/{id}',
            [ClaimController::class, 'create']
        )->name('student.claim-create');


        Route::post(
            '/student/claim',
            [ClaimController::class, 'storeWeb']
        )->name('student.claim-store');


        /*
        |--------------------------------------------------------------------------
        | Student Found Reports
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/my-found-reports/{id}/edit',
            [FoundItemController::class, 'edit']
        )->name('student.found-report-edit');


        Route::put(
            '/student/my-found-reports/{id}',
            [FoundItemController::class, 'updateWeb']
        )->name('student.found-report-update');


        Route::get(
            '/student/my-found-reports/{id}',
            [FoundItemController::class, 'show']
        )->name('student.found-report-details');


        /*
        |--------------------------------------------------------------------------
        | Student My Reports
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/my-reports',
            [LostItemController::class, 'myReports']
        )->name('student.my-reports');


        Route::get(
            '/student/my-found-reports',
            [FoundItemController::class, 'myReports']
        )->name('student.my-found-reports');


        /*
        |--------------------------------------------------------------------------
        | Student Lost Reports
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/student/my-reports/{id}/edit',
            [LostItemController::class, 'edit']
        )->name('student.report-edit');


        Route::put(
            '/student/my-reports/{id}',
            [LostItemController::class, 'update']
        )->name('student.report-update');


        Route::delete(
            '/student/my-reports/{id}',
            [LostItemController::class, 'destroy']
        )->name('student.report-delete');


        Route::get(
            '/student/my-reports/{id}',
            [LostItemController::class, 'show']
        )->name('student.report-details');


        /*
        |--------------------------------------------------------------------------
        | Student Report Lost
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/student/report-lost',
            [LostItemController::class, 'store']
        );


        Route::get('/student/report-lost', function () {

            $categories = \App\Models\Category::all();
            $locations = \App\Models\Location::all();

            return view(
                'student.report-lost',
                compact('categories', 'locations')
            );

        });


        /*
        |--------------------------------------------------------------------------
        | Student Report Found
        |--------------------------------------------------------------------------
        */

        Route::post(
            '/student/report-found',
            [FoundItemController::class, 'store']
        );


        Route::get('/student/report-found', function () {

            $categories = \App\Models\Category::all();
            $locations = \App\Models\Location::all();
            $compensationRules = \App\Models\CompensationRule::all();

            return view(
                'student.report-found',
                compact(
                    'categories',
                    'locations',
                    'compensationRules'
                )
            );

        });

    });


    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', function () {

        $notifications = \App\Models\Notification::where(
            'user_id',
            auth()->id()
        )
            ->latest()
            ->get();

        return view(
            'student.notifications',
            compact('notifications')
        );

    })->name('notifications');


    Route::post('/notifications/{id}/read', function ($id) {

        $notification = \App\Models\Notification::where(
            'user_id',
            auth()->id()
        )
            ->findOrFail($id);

        $notification->update([
            'is_read' => true,
        ]);

        return back();

    })->name('notification-read');


    /*
    |--------------------------------------------------------------------------
    | Faculty Dashboard
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:faculty'])->group(function () {

        Route::get('/faculty/dashboard', function () {

            $lostItems = \App\Models\LostItem::count();

            $foundItems = \App\Models\FoundItem::count();

            $pendingClaims = \App\Models\Claim::where(
                'status',
                'pending'
            )->count();


            $pendingClaimsList = \App\Models\Claim::with([
                'foundItem',
                'claimant'
            ])
                ->where(
                    'status',
                    'pending'
                )
                ->latest()
                ->take(5)
                ->get();


            $resolvedClaims = \App\Models\Claim::where(
                'status',
                'approved'
            )->count();


            $recentLostItems = \App\Models\LostItem::with('user')
                ->latest()
                ->take(5)
                ->get();


            $recentFoundItems = \App\Models\FoundItem::with('user')
                ->latest()
                ->take(5)
                ->get();


            $recentReports = collect(
    $recentLostItems->map(function ($item) {

        return [
            'item_name' => $item->item_name,
            'type' => 'Lost',
            'reported_by' =>
                $item->user->name ?? 'Unknown',
            'date' => $item->lost_date,
            'status' => $item->status,
            'created_at' => $item->created_at,
        ];

    })->all()
)->merge(
    $recentFoundItems->map(function ($item) {

        return [
            'item_name' => $item->item_name,
            'type' => 'Found',
            'reported_by' =>
                $item->user->name ?? 'Unknown',
            'date' => $item->found_date,
            'status' => $item->status,
            'created_at' => $item->created_at,
        ];

    })->all()
)
    ->sortByDesc('created_at')
    ->take(5)
    ->values();

            return view(
                'faculty.dashboard',
                compact(
                    'lostItems',
                    'foundItems',
                    'pendingClaims',
                    'resolvedClaims',
                    'recentReports',
                    'pendingClaimsList'
                )
            );

        })->name('faculty.dashboard');

    });


    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/reports', [AdminReportController::class, 'index'])
        ->middleware(['auth', 'role:admin'])
        ->name('admin.reports');
        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/dashboard', function () {

            $totalUsers = \App\Models\User::count();

            $totalLostItems = \App\Models\LostItem::count();

            $totalFoundItems = \App\Models\FoundItem::count();

            $pendingClaims = \App\Models\Claim::where(
                'status',
                'pending'
            )->count();

            $resolvedItems = \App\Models\Claim::where(
                'status',
                'approved'
            )->count();


            $recentLostItems = \App\Models\LostItem::with('user')
                ->latest()
                ->take(5)
                ->get();


            $recentFoundItems = \App\Models\FoundItem::with('user')
                ->latest()
                ->take(5)
                ->get();


            $recentClaims = \App\Models\Claim::with('claimant')
                ->latest()
                ->take(5)
                ->get();


            $recentActivities = collect();


            foreach ($recentLostItems as $item) {

                $recentActivities->push([
                    'type' => 'lost',
                    'message' =>
                        ($item->user->name ?? 'A user') .
                        ' reported a lost item',
                    'date' => $item->created_at,
                ]);

            }


            foreach ($recentFoundItems as $item) {

                $recentActivities->push([
                    'type' => 'found',
                    'message' =>
                        ($item->user->name ?? 'A user') .
                        ' reported a found item',
                    'date' => $item->created_at,
                ]);

            }


            foreach ($recentClaims as $claim) {

                $recentActivities->push([
                    'type' => 'claim',
                    'message' =>
                        ($claim->claimant->name ?? 'A user') .
                        ' submitted a claim',
                    'date' => $claim->created_at,
                ]);

            }


            $recentActivities = $recentActivities
                ->sortByDesc('date')
                ->take(5)
                ->values();


            return view(
                'admin.dashboard',
                compact(
                    'totalUsers',
                    'totalLostItems',
                    'totalFoundItems',
                    'pendingClaims',
                    'resolvedItems',
                    'recentActivities'
                )
            );

        })->name('admin.dashboard');


        /*
        |--------------------------------------------------------------------------
        | Admin Compensation
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin/compensations',
            [CompensationController::class, 'adminCompensations']
        )->name('admin.compensations');


        Route::get(
            '/admin/compensations/{id}',
            [CompensationController::class, 'adminCompensationDetails']
        )->name('admin.compensation-details');


        Route::delete(
            '/admin/compensations/{id}',
            [CompensationController::class, 'adminDeleteCompensation']
        )->name('admin.compensation-delete');


        Route::post(
            '/admin/compensations/{id}/paid',
            [CompensationController::class, 'markAsPaid']
        )->name('admin.compensation-paid');


        /*
        |--------------------------------------------------------------------------
        | Admin Claims
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin/claims',
            [ClaimController::class, 'adminClaims']
        )->name('admin.claims');


        Route::get(
            '/admin/claims/{id}',
            [ClaimController::class, 'adminClaimDetails']
        )->name('admin.claim-details');

        Route::post(
            '/admin/claims/{id}/schedule',
            [ClaimController::class, 'schedule']
        )->name('admin.claim-schedule');


        Route::post(
            '/admin/claims/{id}/approve',
            [ClaimController::class, 'approve']
        )->name('admin.claim-approve');


        Route::post(
            '/admin/claims/{id}/reject',
            [ClaimController::class, 'reject']
        )->name('admin.claim-reject');


        Route::delete(
            '/admin/claims/{id}',
            [ClaimController::class, 'adminDeleteClaim']
                )->name('admin.claim-delete');

                Route::post('/admin/claims/{id}/schedule', [ClaimController::class, 'schedule'])
            ->name('admin.claim-schedule');

        Route::post('/admin/claims/{id}/approve', [ClaimController::class, 'approve'])
            ->name('admin.claim-approve');

        Route::post('/admin/claims/{id}/reject', [ClaimController::class, 'reject'])
            ->name('admin.claim-reject');


/*
|--------------------------------------------------------------------------
| Admin Found Items
|--------------------------------------------------------------------------
*/

Route::get(
    '/admin/found-items',
    [FoundItemController::class, 'adminFoundItems']
)->name('admin.found-items');


Route::get(
    '/admin/found-items/{id}',
    [FoundItemController::class, 'adminFoundItemDetails']
)->name('admin.found-item-details');


Route::post(
    '/admin/found-items/{id}/receive',
    [FoundItemController::class, 'receiveFoundItem']
)->name('admin.found-item-receive');


Route::post(
    '/admin/found-items/{id}/approve',
    [FoundItemController::class, 'approveFoundItem']
)->name('admin.found-item-approve');


Route::post(
    '/admin/found-items/{id}/reject',
    [FoundItemController::class, 'rejectFoundItem']
)->name('admin.found-item-reject');


Route::delete(
    '/admin/found-items/{id}',
    [FoundItemController::class, 'adminDeleteFoundItem']
)->name('admin.found-item-delete');


        /*
        |--------------------------------------------------------------------------
        | Admin Lost Items
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin/lost-items',
            [LostItemController::class, 'adminLostItems']
        )->name('admin.lost-items');


        Route::get(
            '/admin/lost-items/{id}',
            [LostItemController::class, 'adminLostItemDetails']
        )->name('admin.lost-item-details');


        Route::delete(
            '/admin/lost-items/{id}',
            [LostItemController::class, 'adminDeleteLostItem']
        )->name('admin.lost-item-delete');


        /*
        |--------------------------------------------------------------------------
        | Admin Users
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin/users',
            [UserController::class, 'manageUsers']
        )->name('admin.users');


        Route::get(
            '/admin/users/{id}',
            [UserController::class, 'viewUser']
        )->name('admin.user-details');


        Route::post(
            '/admin/users/{id}/deactivate',
            [UserController::class, 'deactivateUser']
        )->name('admin.user-deactivate');


        Route::post(
            '/admin/users/{id}/reactivate',
            [UserController::class, 'reactivateUser']
        )->name('admin.user-reactivate');


        Route::delete(
            '/admin/users/{id}',
            [UserController::class, 'deleteUser']
        )->name('admin.user-delete');


        /*
        |--------------------------------------------------------------------------
        | Faculty Registration Requests
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/admin/faculty-requests',
            [UserController::class, 'pendingFaculty']
        )->name('admin.faculty-requests');


        Route::post(
            '/admin/faculty-requests/{id}/approve',
            [UserController::class, 'approveFaculty']
        )->name('admin.faculty-approve');


        Route::post(
            '/admin/faculty-requests/{id}/reject',
            [UserController::class, 'rejectFaculty']
        )->name('admin.faculty-reject');


        /*
        |--------------------------------------------------------------------------
        | Admin Personal Reports
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/report-found', function () {

            $categories = \App\Models\Category::all();
            $locations = \App\Models\Location::all();

            return view(
                'faculty.report-found',
                compact(
                    'categories',
                    'locations'
                )
            );

        })->name('admin.report-found');


        Route::post(
            '/admin/report-found',
            [FoundItemController::class, 'store']
        )->name('admin.report-found.store');


        Route::get('/admin/report-lost', function () {

            $categories = \App\Models\Category::all();
            $locations = \App\Models\Location::all();

            return view(
                'faculty.report-lost',
                compact(
                    'categories',
                    'locations'
                )
            );

        })->name('admin.report-lost');


        Route::post(
            '/admin/report-lost',
            [LostItemController::class, 'store']
        )->name('admin.report-lost.store');


        Route::get(
            '/admin/my-reports',
            [LostItemController::class, 'adminMyReports']
        )->name('admin.my-reports');


        //logs

        Route::get('/admin/logs', [ActivityLogController::class, 'index'])
        ->name('admin.logs');

    });


});


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('prevent.back')->group(function () {

    Route::get(
        '/register',
        [RegisterController::class, 'showRegister']
    )->name('register');


    Route::post(
        '/register',
        [RegisterController::class, 'register']
    );


    Route::get(
        '/login',
        [LoginController::class, 'showLogin']
    )->name('login');


    Route::post(
        '/login',
        [LoginController::class, 'login']
    );

});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post(
    '/logout',
    [LoginController::class, 'logout']
)->name('logout');