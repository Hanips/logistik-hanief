<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        $id = Auth::user()->id;
        $rs = User::find($id);
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();

        return view('profile.profile', compact('rs', 'notifications'));
    }

    public function editProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $roles = User::ROLES;
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
    
        return view('profile.edit_profile', compact('user', 'roles', 'notifications'));
    }
    
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
    
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
    
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
    
        return response()->json(['message' => 'Profil berhasil diperbarui']);
    }
    
    public function editPassword()
    {
        $id = Auth::user()->id;
        $notifications = Notification::orderByRaw("CASE WHEN notification_status = 0 THEN 0 ELSE 1 END, updated_at DESC")->limit(10)->get();
    
        return view('profile.change_password', compact('notifications'));
    }
    
    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
    
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);
    
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }
    
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    
        return response()->json(['message' => 'Password berhasil diubah']);
    }
}
