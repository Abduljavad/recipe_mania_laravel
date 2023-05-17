<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function follow(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $authUser = $request->user();

        if ($authUser->isFollowing($user)) {
            return redirect()->back()->with('error', 'You are already following this user.');
        }
        $authUser->followings()->attach($user);

        return redirect()->back()->with('success', 'You are now following ' . $user->name);
    }

    public function unfollow(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $authUser = $request->user();

        if (!$authUser->isFollowing($user)) {
            return redirect()->back()->with('error', 'You are not following this user.');
        }
        $authUser->followings()->detach($user);

        return redirect()->back()->with('success', 'You have unfollowed ' . $user->name);
    }

    public function profileEdit()
    {
        $user = auth()->user();
        return view('user.user-profile', compact('user'));
    }
    public function profileUpdate(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail(auth()->user()->id);
        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
