<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\MedicineCategories;
use App\Models\MedicineContent;

class MedicineController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view medicines')->only('index','show');
        $this->middleware('permission:create medicines')->only(['create','store']);
        $this->middleware('permission:edit medicines')->only(['edit','update']);
        $this->middleware('permission:delete medicines')->only('destroy');
    }


    public function index()
    {  
        $medicineContents = MedicineContent::with('medicineCategory')
        ->orderBy('id', 'desc')
        ->get();
        return view('backend.pages.medicine-content.index', compact('medicineContents'));
    }

    public function create()
    {        
        $MedicineCategories = MedicineCategories::orderBy('id', 'desc')->get();
        return view('backend.pages.medicine-content.create', compact('MedicineCategories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'medicine_category' => 'required|exists:medicine_categories,id',
            'mhh' => 'required|string|max:255',
            'th' => 'nullable|string|max:255',
            'dosage_form' => 'nullable|string|max:255',
            'medicine_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'medicine_short_content' => 'nullable|string',
            'content' => 'nullable|string',
            'status' => 'boolean',
        ]);
        DB::beginTransaction();
        try {
            $imageName = null;   
            if ($request->hasFile('medicine_image')) {
                $destinationPath = public_path('upload/medicine');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }                
                $safeTitle = Str::slug($request->medicine_name);
                $imageFile = $request->file('medicine_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeTitle . '-' . $uniqueTimestamp . '.webp';                
                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }
            $baseSlug = Str::slug($validatedData['mhh']);
            $slug = $baseSlug;
            $counter = 1;
            while (MedicineContent::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            $medicine = MedicineContent::create([
                'medicine_category_id' => $validatedData['medicine_category'],
                'title' => $validatedData['mhh'],
                'trade_name' => $validatedData['th'],
                'dosage_form' => $validatedData['dosage_form'],
                'slug' => $slug,
                'image' => $imageName,
                'short_content' => $validatedData['medicine_short_content'] ?? null,
                'content' => $validatedData['content'] ?? null,
                'status' => $validatedData['status'] ?? 1,
            ]);
            DB::commit();

            return redirect()->route('manage-medicine.index')
                ->with('success', 'Medicine created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            if (isset($imageName) && file_exists(public_path('upload/medicine/' . $imageName))) {
                unlink(public_path('upload/medicine/' . $imageName));
            }
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error creating medicine: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {     
        $MedicineCategories = MedicineCategories::orderBy('id', 'desc')->get();   
        $medicine_row = MedicineContent::findOrFail($id);
        return view('backend.pages.medicine-content.edit', compact('medicine_row', 'MedicineCategories'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'medicine_category' => 'required|exists:medicine_categories,id',
            'mhh' => 'required|string|max:255',
            'th' => 'nullable|string|max:255',
            'dosage_form' => 'nullable|string|max:255',
            'medicine_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'medicine_short_content' => 'nullable|string',
            'content' => 'nullable|string',
            'status' => 'boolean',
            'remove_image' => 'nullable|boolean',
            'current_image' => 'nullable|string'
        ]);
        DB::beginTransaction();
        try {
            $medicine = MedicineContent::findOrFail($id);
            $imageName = $medicine->image;
            if ($request->has('remove_image') && $request->remove_image) {
                if ($imageName && file_exists(public_path('upload/medicine/' . $imageName))) {
                    unlink(public_path('upload/medicine/' . $imageName));
                }
                $x = null;
            }
            if ($request->hasFile('medicine_image')) {
                $destinationPath = public_path('upload/medicine');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                if ($imageName && file_exists(public_path('upload/medicine/' . $imageName))) {
                    unlink(public_path('upload/medicine/' . $imageName));
                }
                $safeTitle = Str::slug($request->medicine_name);
                $imageFile = $request->file('medicine_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeTitle . '-' . $uniqueTimestamp . '.webp';                
                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }

            $medicine->update([
                'medicine_category_id' => $validatedData['medicine_category'],
                'title' => $validatedData['mhh'],
                'trade_name' => $validatedData['th'] ?? null,
                'dosage_form' => $validatedData['dosage_form'] ?? null,
                'image' => $imageName,
                'short_content' => $validatedData['medicine_short_content'] ?? null,
                'content' => $validatedData['content'] ?? null,
                'status' => $validatedData['status'] ?? 0,
            ]);
            DB::commit();
            return redirect()->route('manage-medicine.index')
                ->with('success', 'Medicine updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating medicine: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();        
        try {
            $medicine = MedicineContent::findOrFail($id);
            if ($medicine->image && file_exists(public_path('upload/medicine/' . $medicine->image))) {
                unlink(public_path('upload/medicine/' . $medicine->image));
            }
            $medicine->delete();            
            DB::commit();  
            return redirect()->route('manage-medicine.index')
                ->with('success', 'Medicine deleted successfully');     
                    
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('manage-medicine.index')
                ->with('success', 'Error deleting medicine: ' . $e->getMessage());     
        }
    }


}
