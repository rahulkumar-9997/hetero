<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use App\Models\MedicineCategories;

class MedicineCategoryController extends Controller
{
    public function index()
    {        
        $medicineCategory = MedicineCategories::orderBy('id', 'desc')->get();
        return view('backend.pages.medicine-category.index', compact('medicineCategory'));
    }

    public function create(Request $request){
        $url = $request->input('url'); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('medicine-category.store').'" accept-charset="UTF-8" enctype="multipart/form-data" id="medicineCategoryAddForm">
                '.csrf_field().'
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="medicine_category_name" class="form-label">Medicine Category Name *</label>
                            <input type="text" name="medicine_category_name" class="form-control" id="medicine_category_name">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="medicine_category_image" class="form-label">Medicine Category Image </label>
                            <input type="file" name="medicine_category_image" class="form-control" id="medicine_category_image">
                        </div>
                    </div>
                    <div class="mb-3 col-md-2 mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" checked>
                            <label class="form-check-label" for="status">Status</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="medicine_content" class="form-label">Content</label>
                            <textarea name="medicine_content" class="editor_class_multiple"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 pe-2">
                        <button type="button" class="btn btn-cancel waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
                    </div>                    
                </div>
            </form>
        </div>
        ';
        return response()->json([
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'medicine_category_name' => 'required|string|max:255',
            'medicine_content' => 'nullable|string',
            'medicine_category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        DB::beginTransaction();
        try {
            $imageName = null;
            if ($request->hasFile('medicine_category_image')) {
                $destinationPath = public_path('upload/medicine-category');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                $safeTitle = Str::slug($request->medicine_category_name);
                $imageFile = $request->file('medicine_category_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeTitle.'-' . $uniqueTimestamp . '.webp';
                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }
            $category = MedicineCategories::create([
                'title' => $request->medicine_category_name,
                'image' => $imageName,
                'content' => $request->medicine_content,                
                'status' => $request->has('status') ? 1 : 0,
            ]);
            DB::commit();
            $medicineCategory = MedicineCategories::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Medicine category created successfully!',
                'medicineCategoryData' => view('backend.pages.medicine-category.partials.medicine-category', compact('medicineCategory'))->render(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit(Request $request, $id){
        $medicine_category_row = MedicineCategories::findOrFail($id);
        if($medicine_category_row->image)
        {
            $imageUrl = asset('upload/medicine-category/' . $medicine_category_row->image);
            $imageFile = '<img src="' . $imageUrl . '" width="100">';
        }
        else{
            $imageFile = null;
        }
        
        $url = $request->input('url'); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('medicine-category.update', $id).'" accept-charset="UTF-8" enctype="multipart/form-data" id="medicineCategoryEditForm">
                '.csrf_field().'
                '.method_field('PUT').'
                <div class="row">
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="medicine_category_name" class="form-label">Medicine Category Name *</label>
                            <input type="text" name="medicine_category_name" class="form-control" id="medicine_category_name" value="'.$medicine_category_row->title.'">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label for="medicine_category_image" class="form-label">Medicine Category Image </label>
                            <input type="file" name="medicine_category_image" class="form-control" id="medicine_category_image">
                            '.$imageFile.'
                        </div>
                    </div>
                    <div class="mb-3 col-md-2 mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="status" name="status" value="1" '.($medicine_category_row->status == 1 ? 'checked' : '').'>
                            <label class="form-check-label" for="status">Status</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="medicine_content" class="form-label">Content</label>
                            <textarea name="medicine_content" class="editor_class_multiple">'.$medicine_category_row->content.'</textarea>
                        </div>
                    </div>
                    <div class="modal-footer pb-0 pe-2">
                        <button type="button" class="btn btn-cancel waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                    </div>                    
                </div>
            </form>
        </div>
        ';
        return response()->json([
            'message' => 'Form created successfully',
            'form' => $form,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicine_category_name' => 'required|string|max:255',
            'medicine_content' => 'nullable|string',
            'medicine_category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
        DB::beginTransaction();
        try {
            $category = MedicineCategories::findOrFail($id);
            $imageName = $category->image;
            if ($request->hasFile('medicine_category_image')) {
                $destinationPath = public_path('upload/medicine-category');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                if ($imageName && File::exists($destinationPath . '/' . $imageName)) {
                    File::delete($destinationPath . '/' . $imageName);
                }
                $safeTitle = Str::slug($request->medicine_category_name);
                $imageFile = $request->file('medicine_category_image');
                $uniqueTimestamp = round(microtime(true) * 1000);
                $imageName = $safeTitle . '-' . $uniqueTimestamp . '.webp';

                $image = Image::make($imageFile);
                $image->encode('webp', 75);
                $image->save($destinationPath . '/' . $imageName);
            }
            $category->update([
                'title' => $request->medicine_category_name,
                'image' => $imageName,
                'content' => $request->medicine_content,
                'status' => $request->has('status') ? 1 : 0,
            ]);
            DB::commit();
            $medicineCategory = MedicineCategories::orderBy('id', 'desc')->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Medicine category updated successfully!',
                'medicineCategoryData' => view('backend.pages.medicine-category.partials.medicine-category', compact('medicineCategory'))->render(),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update category: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = MedicineCategories::findOrFail($id);
            if ($category->image) {
                $imagePath = public_path('upload/medicine-category/' . $category->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $category->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Medicine category deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }

    
}
