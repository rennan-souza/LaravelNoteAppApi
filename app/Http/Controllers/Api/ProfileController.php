<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

    public function  __construct()
    {
        $this->middleware('auth:api');
    }

    public function showProfile()
    {
        return User::find(Auth::user()->id);
    }

    public function addAvatar(UserAvatarRequest $request)
    {
        
        $user = User::find(Auth::user()->id);


        if ($user->avatar) {
            $avatarDelete = public_path('assets/avatars/'.$user->avatar);
            unlink($avatarDelete);
        }

        $avatar = $request->file('avatar');
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
        $destinationPath = public_path('/assets/avatars');
        $avatar->move($destinationPath, $avatarName);

        $user->avatar = $avatarName;
        $user->save();

        return response()->json($user, 201);
    }

    public function removeAvatar()
    {
        $user = User::find(Auth::user()->id);

        if ($user->avatar) {
            $avatarDelete = public_path('assets/avatars/'.$user->avatar);
            unlink($avatarDelete);
        }

        $user->avatar = null;
        $user->save();

        return response()->json('', 204);
    }
}
