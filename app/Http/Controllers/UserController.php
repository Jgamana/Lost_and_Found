<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function facultyDashboard()
    {
        $lostItems = \App\Models\LostItem::count();

        $foundItems = \App\Models\FoundItem::count();

        $pendingClaims = \App\Models\Claim::where(
            'status',
            'pending'
        )->count();

        $resolvedClaims = \App\Models\Claim::whereIn(
            'status',
            ['approved', 'rejected']
        )->count();

        return view(
            'faculty.dashboard',
            compact(
                'lostItems',
                'foundItems',
                'pendingClaims',
                'resolvedClaims'
            )
        );
    }

    public function pendingFaculty()
    {
        $faculty = \App\Models\User::where('role', 'faculty')
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view(
            'admin.faculty-requests',
            compact('faculty')
        );
    }

    public function approveFaculty($id)
    {
        $faculty = \App\Models\User::where('role', 'faculty')
            ->where('status', 'pending')
            ->findOrFail($id);

        $faculty->update([
            'status' => 'approved',
        ]);

        ActivityLog::record(
            'Approve Faculty Account',
            'Approved faculty account for ' .
            $faculty->name .
            ' (' .
            $faculty->email .
            ').'
        );

        return back()->with(
            'success',
            'Faculty account approved successfully.'
        );
    }

    public function rejectFaculty($id)
    {
        $faculty = \App\Models\User::where('role', 'faculty')
            ->where('status', 'pending')
            ->findOrFail($id);

        $faculty->update([
            'status' => 'rejected',
        ]);

        ActivityLog::record(
            'Reject Faculty Account',
            'Rejected faculty account for ' .
            $faculty->name .
            ' (' .
            $faculty->email .
            ').'
        );

        return back()->with(
            'success',
            'Faculty account rejected successfully.'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        ActivityLog::record(
            'Create User',
            'Created user account for ' .
            $user->name .
            ' (' .
            $user->email .
            ') with role ' .
            $user->role .
            '.'
        );

        return response()->json($user, 201);
    }

    public function show(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        ActivityLog::record(
            'Update User',
            'Updated user account for ' .
            $user->name .
            ' (' .
            $user->email .
            ').'
        );

        return response()->json($user);
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        ActivityLog::record(
            'Delete User',
            'Deleted user account for ' .
            $user->name .
            ' (' .
            $user->email .
            ').'
        );

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully'
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        return view(
            'profile',
            compact('user')
        );
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'contact_number' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
        ]);

        ActivityLog::record(
            'Update Profile',
            'Updated profile information for ' .
            $user->name .
            '.'
        );

        return back()->with(
            'success',
            'Profile updated successfully.'
        );
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check(
            $request->current_password,
            $user->password
        )) {
            return back()->withErrors([
                'current_password' =>
                    'The current password is incorrect.'
            ]);
        }

        $user->update([
            'password' =>
                \Illuminate\Support\Facades\Hash::make(
                    $request->password
                ),
        ]);

        ActivityLog::record(
            'Change Password',
            'Changed account password for ' .
            $user->name .
            '.'
        );

        return back()->with(
            'success',
            'Password changed successfully.'
        );
    }

    public function manageUsers()
    {
        $users = User::latest()->get();

        return view(
            'admin.users',
            compact('users')
        );
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);

        return view(
            'admin.user-details',
            compact('user')
        );
    }

    public function deactivateUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'user' =>
                    'You cannot deactivate your own account.'
            ]);
        }

        $user->update([
            'is_active' => false,
        ]);

        ActivityLog::record(
            'Deactivate User',
            'Deactivated user account for ' .
            $user->name .
            ' (' .
            $user->email .
            ').'
        );

        return back()->with(
            'success',
            'User account deactivated successfully.'
        );
    }

    public function reactivateUser($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'is_active' => true,
        ]);

        ActivityLog::record(
            'Reactivate User',
            'Reactivated user account for ' .
            $user->name .
            ' (' .
            $user->email .
            ').'
        );

        return back()->with(
            'success',
            'User account reactivated successfully.'
        );
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'user' =>
                    'You cannot delete your own account.'
            ]);
        }

        ActivityLog::record(
            'Delete User',
            'Admin deleted user account for ' .
            $user->name .
            ' (' .
            $user->email .
            ').'
        );

        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}