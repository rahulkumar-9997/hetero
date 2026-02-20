<?php
namespace App\Http\Controllers\Backend;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view roles')->only('index','show');
        $this->middleware('permission:create roles')->only(['create','store']);
        $this->middleware('permission:edit roles')->only(['edit','update']);
        $this->middleware('permission:delete roles')->only('destroy');
    }
    public function index(Request $request)
    {   
        $roles = Role::with('permissions')->orderBy('id','DESC')->get();
        return view('backend.pages.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        $groupedPermissions = $permissions->groupBy('group');
        return view('backend.pages.roles.create', compact('groupedPermissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name|regex:/^[a-zA-Z0-9\-_]+$/',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);
        
        try {
            DB::beginTransaction();            
            $role = Role::create([
                'name' => strtolower(str_replace(' ', '-', $request->name)),
                'guard_name' => 'web'
            ]);            
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions); 
            DB::commit(); 
            return redirect()->route('roles.index')
                ->with('success', 'Role created successfully');
                
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        $groupedPermissions = $permissions->groupBy('group');
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('backend.pages.roles.edit', compact('role', 'groupedPermissions', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z0-9\-_]+$/|unique:roles,name,' . $id,
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        try {
            DB::beginTransaction();
            $role = Role::findOrFail($id);
            $role->name = strtolower(str_replace(' ', '-', $request->name));
            $role->save();
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);            
            DB::commit();            
            return redirect()->route('roles.index')
                ->with('success', 'Role updated successfully');
                
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
            DB::beginTransaction();            
            $role = Role::findOrFail($id);
            if($role->users()->count() > 0) {
                return redirect()->route('roles.index')
                    ->with('error', 'Cannot delete role because it is assigned to users');
            }
            if(in_array($role->name, ['admin', 'super-admin'])) {
                return redirect()->route('roles.index')
                    ->with('error', 'Cannot delete system role');
            }
            DB::table('role_has_permissions')->where('role_id', $id)->delete();
            $role->delete();
            DB::commit();
            return redirect()->route('roles.index')
                ->with('success', 'Role deleted successfully');
                
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}