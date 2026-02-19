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
    public function index()
    {   
        $permissions = Permission::orderBy('name')->get();
        return view('backend.pages.permissions.index', compact('permissions'));
    }

    public function create() 
    {   
        return view('backend.pages.permissions.create');
    }

    public function store(Request $request)
    {   
        $this->validate($request, [
            'name' => 'required|unique:permissions,name|regex:/^[a-zA-Z0-9\-]+$/',
            'guard_name' => 'sometimes|string'
        ]);

        try {
            DB::beginTransaction();
            $name = strtolower(str_replace(' ', '-', $request->name));
            Permission::create([
                'name' => $name,
                'guard_name' => $request->guard_name ?? 'web'
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
        return view('backend.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|regex:/^[a-zA-Z0-9\-]+$/|unique:permissions,name,' . $id,
        ]);

        try {
            DB::beginTransaction();            
            $permission = Permission::findOrFail($id);   
            $name = strtolower(str_replace(' ', '-', $request->name));            
            $permission->name = $name;
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
