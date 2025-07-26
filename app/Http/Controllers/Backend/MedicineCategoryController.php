<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicineCategoryController extends Controller
{
    public function index()
    {        
        return view('backend.pages.medicine-category.index');
    }

    public function create(Request $request){
        $url = $request->input('url'); 
        $form ='
        <div class="modal-body">
            <form method="POST" action="'.route('manage-award-category.store').'" accept-charset="UTF-8" enctype="multipart/form-data" id="awardsCategoryAddForm">
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
                    <div class="mb-3 col-md-2">
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
    
}
