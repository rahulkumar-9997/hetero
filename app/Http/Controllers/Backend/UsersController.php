<?php
// app/Http/Controllers/Backend/UsersController.php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use DB;

class UsersController extends Controller
{
    public function index(Request $request) 
    {
        $query = User::query();
        $users = $query->latest()->paginate(10);        
        return view('backend.pages.users.index', compact('users'));
    }

    public function create() 
    {
        $roles = Role::latest()->get();
        return view('backend.pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'nullable|min:10',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:1,0'
        ]);
        try {
            DB::beginTransaction();            
            $input = $request->all();  
            $input['user_id'] = 'USR' . time() . rand(100, 999);
            $input['password'] = Hash::make($input['password']);
            if($request->hasFile('profile_img')) {
                $image = $request->file('profile_img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile-images'), $imageName);
                $input['profile_img'] = $imageName;
            }
            $user = User::create($input);
            $user->assignRole($request->role);
            DB::commit();            
            return redirect()->route('users.index')->with('success', 'User created successfully');
                
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id) 
    {
        $user = User::findOrFail($id);
        $roles = Role::latest()->get();
        $userRole = $user->roles->pluck('name')->first();        
        return view('backend.pages.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'nullable|min:10',
            'role' => 'required',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:1,0'
        ]);

        try {
            DB::beginTransaction();            
            $user = User::findOrFail($id);
            $input = $request->all();
            if($request->hasFile('profile_img')) {
                if($user->profile_img && file_exists(public_path('profile-images/' . $user->profile_img))) {
                    unlink(public_path('profile-images/' . $user->profile_img));
                }                
                $image = $request->file('profile_img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('profile-images'), $imageName);
                $input['profile_img'] = $imageName;
            }
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $user->assignRole($request->role);            
            DB::commit();            
            return redirect()->route('users.index')->with('success', 'User updated successfully');                
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            
            // Prevent self deletion
            if($user->id == auth()->id()) {
                return redirect()->route('users.index')
                    ->with('error', 'You cannot delete your own account');
            }
            
            // Delete profile image
            if($user->profile_img && file_exists(public_path('profile-images/' . $user->profile_img))) {
                unlink(public_path('profile-images/' . $user->profile_img));
            }
            
            $user->delete();
            
            return redirect()->route('users.index')
                ->with('success', 'User deleted successfully');
                
        } catch(\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    
    public function changePassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required|min:8|confirmed',
        ]);
        
        try {
            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password);
            $user->save();
            
            return redirect()->route('users.index')
                ->with('success', 'Password changed successfully');
                
        } catch(\Exception $e) {
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    
    public function updateStatus(Request $request)
    {
        try {
            $user = User::findOrFail($request->user_id);
            
            if($user->id == auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'You cannot change your own status'
                ]);
            }
            
            $user->status = $request->status;
            $user->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);
            
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }
}