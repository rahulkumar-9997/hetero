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
            'medicine_name' => 'required|string|max:255',
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
            $medicine = MedicineContent::create([
                'medicine_category_id' => $validatedData['medicine_category'],
                'title' => $validatedData['medicine_name'],
                'slug' => Str::slug($validatedData['medicine_name']),
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

}
