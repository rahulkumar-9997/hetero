<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view profile')->only('index');
        $this->middleware('permission:update profile')->only('update');
        $this->middleware('permission:delete profile image')->only('deleteImage');
    }

    public function index()
    {
        $user = Auth::user();
        return view('backend.pages.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'phone_number' => 'nullable|string|max:20',
            'status' => 'nullable|string|max:255',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'current_password' => 'nullable|required_with:new_password|current_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
        $data = [
            'name' => $request->name,
            'user_id' => $request->user_id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ];

        if ($request->hasFile('profile_img')) {
            if ($user->profile_img) {
                $oldImagePath = public_path('profile-images/' . $user->profile_img);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('profile_img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile-images'), $filename);            
            $data['profile_img'] = $filename;
        }
        if ($request->filled('new_password')) {
            $data['password'] = Hash::make($request->new_password);
        }
        $user->update($data);
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    
    public function deleteImage()
    {
        $user = Auth::user();        
        if ($user->profile_img) {
            $imagePath = public_path('profile-images/' . $user->profile_img);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $user->update(['profile_img' => null]);
        }
        return back()->with('success', 'Profile image deleted successfully!');
    }
}
