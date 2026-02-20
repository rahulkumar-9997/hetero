<?php
namespace App\Http\Controllers\Backend;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view permissions')->only('index','show');
        $this->middleware('permission:create permissions')->only(['create','store']);
        $this->middleware('permission:edit permissions')->only(['edit','update']);
        $this->middleware('permission:delete permissions')->only('destroy');
    }

    public function index()
    {   
        $permissions = Permission::orderBy('group')->orderBy('name')->get();
        $groupedPermissions = $permissions->groupBy('group');        
        return view('backend.pages.permissions.index', compact('groupedPermissions'));
    }
    public function create() 
    {   
        $existingGroups = Permission::whereNotNull('group')
            ->distinct()
            ->pluck('group')
            ->toArray();            
        return view('backend.pages.permissions.create', compact('existingGroups'));
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|unique:permissions,name|regex:/^[a-zA-Z0-9\-_.]+$/',
            'guard_name' => 'sometimes|string',
            'group' => 'nullable|string|max:100'
        ], [
            'name.required' => 'Permission name is required',
            'name.unique' => 'This permission name already exists',
            'name.regex' => 'Permission name can only contain letters, numbers, hyphens (-), underscores (_), and dots (.)',
        ]);        
        try {
            DB::beginTransaction(); 
            $name = strtolower(str_replace(' ', '-', $request->name));
            Permission::create([
                'name' => $name,
                'guard_name' => $request->guard_name ?? 'web',
                'group' => $request->group ?? null
            ]);
            DB::commit();
            return redirect()->route('permissions.index')
                ->with('success', 'Permission created successfully');                
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $existingGroups = Permission::whereNotNull('group')
            ->distinct()
            ->pluck('group')
            ->toArray();
            
        return view('backend.pages.permissions.edit', compact('permission', 'existingGroups'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name,' . $id . ',id',
            'guard_name' => 'sometimes|string',
            'group' => 'nullable|string|max:100'
        ]);        
        try {
            DB::beginTransaction();
            $permission = Permission::findOrFail($id); 
            $name = strtolower(trim($request->name));
            $name = preg_replace('/\s+/', '-', $name);
            $permission->name = $name;
            $permission->guard_name = $request->guard_name ?? 'web';
            $permission->group = $request->group ?? null;
            $permission->save(); 
            DB::commit();  
            return redirect()->route('permissions.index')
            ->with('success', 'Permission updated successfully');                
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
            $permission = Permission::findOrFail($id);
            $roleCount = DB::table('role_has_permissions')
                ->where('permission_id', $id)
                ->count(); 
            if($roleCount > 0) {
                return redirect()->route('permissions.index')
                    ->with('error', 'Cannot delete permission because it is assigned to roles');
            }  
            $permission->delete();
            DB::commit(); 
            return redirect()->route('permissions.index')
                ->with('success', 'Permission deleted successfully');
                
        } catch(\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}