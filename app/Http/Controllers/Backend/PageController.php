<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$pages = Page::with('parent')->orderBy('order')->get();
        $pages = Page::with('children')->whereNull('parent_id')->orderBy('order')->get();
        return view('backend.pages.page-content.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentPages = Page::get();
        return view('backend.pages.page-content.create', compact('parentPages'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'route_name' => 'nullable|string|max:255|unique:pages,route_name',
                'page_label_name' =>'nullable|string|max:255',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'page_short_content' => 'nullable|string',
                'content' => 'required|string',
                'parent_id' => 'nullable|exists:pages,id',
                'order' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
                'show_in_sidebar' => 'nullable|boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ]);
            $data = [
                'title' => $validated['title'],
                'page_label_name' => $validated['page_label_name'],
                'route_name' => $validated['route_name'] ?? null,
                'short_content' => $validated['page_short_content'] ?? null,
                'content' => $validated['content'] ?? null,
                'parent_id' => $validated['parent_id'] ?? null,
                'order' => $validated['order'] ?? 0,
                'is_active' => $request->boolean('is_active'),
                'show_in_sidebar' => $request->boolean('show_in_sidebar'),
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ];
            if ($request->hasFile('main_image')) {
                $data['main_image'] = $this->handleImageUpload($request->file('main_image'), $validated['title']);
            }
            $page = Page::create($data);
            DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Page created successfully.',
                    'redirect_url' => route('pages.index')
                ]);
            }
            return redirect()->route('pages.index')->with('success', 'Page created successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->errors() ? array_values($e->errors())[0][0] : 'Validation error',
                    'errors' => $e->errors()
                ], 422);
            }            
            throw $e;            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Page creation failed: ' . $e->getMessage(), [
                'exception' => $e,
                'request_data' => $request->all()
            ]);            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }            
            return back()->withInput()->with('error', 'Failed to create page: ' . $e->getMessage());
        }
    }

    /**
     * Upload and convert image to webp.
     */
    private function handleImageUpload($imageFile, $title): string
    {
        try {
            $destinationPath = public_path('upload/page');
            $safeTitle = Str::slug($title);
            
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $filename = $safeTitle . '-' . uniqid() . '.webp';
            $img = Image::make($imageFile->getRealPath())->encode('webp', 90);
            
            if (!$img->save($destinationPath . '/' . $filename)) {
                throw new \Exception('Failed to save image');
            }            
            return $filename;            
        } catch (\Exception $e) {
            Log::error('Image upload failed: ' . $e->getMessage());
            throw new \Exception('Failed to upload image: ' . $e->getMessage());
        }
    }

    public function edit(Page $page)
    {
        $pages = Page::all();
        $parentPages = Page::where('id', '!=', $page->id)->get();
        return view('backend.pages.page-content.edit', compact('pages', 'parentPages', 'page'));
    }

    public function update(Request $request, Page $page)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'page_label_name' =>'nullable|string|max:255',
                'route_name' => 'nullable|string|max:255|unique:pages,route_name,' . $page->id,
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'page_short_content' => 'nullable|string',
                'content' => 'required|string',
                'parent_id' => 'nullable|exists:pages,id',
                'order' => 'nullable|integer',
                'is_active' => 'nullable|boolean',
                'show_in_sidebar' => 'nullable|boolean',
                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
            ]);
            $data = [
                'title' => $validated['title'],
                'page_label_name' => $validated['page_label_name'],
                'route_name' => $validated['route_name'] ?? null,
                'short_content' => $validated['page_short_content'] ?? null,
                'content' => $validated['content'] ?? null,
                'parent_id' => $validated['parent_id'] ?? null,
                'order' => $validated['order'] ?? 0,
                'is_active' => $request->boolean('is_active'),
                'show_in_sidebar' => $request->boolean('show_in_sidebar'),
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
            ];
            if ($request->hasFile('main_image')) {
                if ($page->main_image && File::exists(public_path('upload/page/' . $page->main_image))) {
                    File::delete(public_path('upload/page/' . $page->main_image));
                }                
                $data['main_image'] = $this->handleImageUpload($request->file('main_image'), $validated['title']);
            }
            $page->update($data);
            DB::commit();
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Page updated successfully.',
                    'redirect_url' => route('pages.index')
                ]);
            }
            return redirect()->route('pages.index')->with('success', 'Page updated successfully.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->errors() ? array_values($e->errors())[0][0] : 'Validation error',
                    'errors' => $e->errors()
                ], 422);
            }            
            throw $e;            
        } catch (\Exception $e) {
            DB::rollBack();            
            Log::error('Page update failed: ' . $e->getMessage(), [
                'exception' => $e,
                'page_id' => $page->id,
                'request_data' => $request->all()
            ]);            
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                ], 500);
            }            
            return back()->withInput()->with('error', 'Failed to update page: ' . $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if ($page->main_image && File::exists(public_path('upload/page/' . $page->main_image))) {
            File::delete(public_path('upload/page/' . $page->main_image));
        }
        
        $page->delete();
        
        return redirect()->route('pages.index')->with('success', 'Page deleted successfully.');
    }
}
