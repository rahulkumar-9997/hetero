<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsMediaRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\NewsAndMediaCategory;
use App\Models\Year;
use App\Models\PressKit;
use App\Models\NewsRoom;
use App\Models\FeaturedStory;

class NewsMediaController extends Controller
{
    public function index(Request $request){
        $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
        if($request->has('newsMediaId')){
            $newsRooms = NewsRoom::with('newsMediaCategory')
            ->where('new_and_media_category_id', $request->newsMediaId)->get();
            if($newsRooms){
                return view('backend.pages.news-media.index', compact('newsRooms', 'newsMediaCategories'));
            }
        }
        else
        {
            $featuredStories = FeaturedStory::with('newsMediaCategory')->orderBy('id', 'desc')->get();
            return view('backend.pages.news-media.index', compact('newsMediaCategories', 'featuredStories'));
        }        
        
        
    }

    public function create(){
        $years = Year::orderBy('id', 'desc')->get();
        $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
        return view('backend.pages.news-media.create', compact('newsMediaCategories', 'years'));
    }

    public function store(StoreNewsMediaRequest $request)
    {
        try {
           
            $data = $request->validated();
            //dd($data);
            $mediaType = $data['media-action-type'];
            $categoryId = $data['news_media_categories'];
            switch ($mediaType) {
                case 'featured-stories':
                    //dd($request->all());
                    $item = $this->createFeaturedStory($data, $categoryId);
                    break;
                case 'newsroom':
                    $item = $this->createNewsRoom($data, $categoryId);
                    break;
                case 'press-kit':
                    $item = $this->createPressKit($data, $categoryId);
                    break;
                default:
                    return back()->with('error', 'Invalid media type');
            }
            return redirect()->route('manage-news-media.index')
                ->with('success', ucfirst(str_replace('-', ' ', $mediaType)) . ' created successfully');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating item: ' . $e->getMessage());
        }
    }

    protected function createFeaturedStory($data, $categoryId)
    {
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (FeaturedStory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        return FeaturedStory::create([
            'new_and_media_category_id' => $categoryId,
            'title' => $data['title'],
            'sub_title' => $data['subtitle'] ?? null,
            'slug' => $slug,
            'content' => $data['content'],
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'status' => isset($data['is_active']) ? 1 : 0,
        ]);
    }

    protected function createNewsRoom($data, $categoryId)
    {
        $date = now();
        $year = $date->format('Y');
        $month = strtolower($date->format('F'));
        $day = $date->format('j');
        $baseSlug = "press-release-{$year}-{$month}-{$day}";        
        $slug = $baseSlug;
        $count = 1;
        while (NewsRoom::where('slug', $slug)->exists()) {
            $slug = "press-release-{$year}-{$month}-{$day}-" . $count;
            $count++;
        }
        if (isset($data['image'])) {
            $destinationPath = public_path('upload/news-room');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $imagePath = $this->processAndStoreImage($data['image'], $data['title'], $destinationPath);
        }
        else {
            $imagePath = null;
        }
        return NewsRoom::create([
            'new_and_media_category_id' => $categoryId,
            'title' => $data['title'],
            'slug' => $slug,
            'image' => $imagePath,
            'year_id' => $data['years'],
            'location' => $data['location'],
            'content' => $data['content'],
            'post_date' => $data['post_date'],
            'meta_title' => $data['meta_title'] ?? null,
            'meta_description' => $data['meta_description'] ?? null,
            'status' => isset($data['is_active']) ? 1 : 0,
        ]);
    }

    protected function createPressKit($data, $categoryId){
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (PressKit::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        if (isset($data['image'])) {
            $destinationPath = public_path('upload/press-kit/image');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $imagePath = $this->processAndStoreImage($data['image'], $data['title'], $destinationPath);
        } else {
            $imagePath = null;
        }
        $pdfPath = $this->storePdfFile($data['pdf_file'], $data['title']);
        return PressKit::create([
            'new_and_media_category_id' => $categoryId,
            'title' => $data['title'],
            'slug' => $slug,
            'image' => $imagePath,
            'download_pdf_file' => $pdfPath,
            'status' => isset($data['is_active']) ? 1 : 0,
        ]);
    }

    protected function processAndStoreImage($imageFile, $title, $destinationPath)
    {
       
        $safeTitle = Str::slug($title);
        $filename = $safeTitle . '-' . uniqid() . '.webp';
        $path = $destinationPath . '/' . $filename;
        $img = Image::make($imageFile)
            ->encode('webp', 75) 
            ->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
            ->save($path);
        return $filename;
    }

    protected function storePdfFile($pdfFile, $title)
    {
        $destinationPath = public_path('upload/press-kit/pdf');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
        $safeTitle = Str::slug($title);
        $filename = $safeTitle . '-' . uniqid() . '.pdf';
        $path = $destinationPath . '/' . $filename;
        $pdfFile->move($destinationPath, $filename);
        return $filename;
    }

    public function edit($id)
    {
        $mediaType = request()->get('action');
        if($mediaType == 'newsroom'){
            $newsRoom = NewsRoom::with('newsMediaCategory')->findOrFail($id);
            $years = Year::orderBy('id', 'desc')->get();
            $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
            return view('backend.pages.news-media.edit', compact('newsRoom', 'years', 'newsMediaCategories'));
        }
        
    }

    public function newRoomUpdate(Request $request, $id)
    {
        $newsRoomRow = NewsRoom::findOrfail($id);
        $validator = Validator::make($request->all(), [
            'news_media_categories' => 'required|exists:news_and_media_categories,id',
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('news_rooms')->ignore($newsRoomRow->id)
            ],
            'years' => 'nullable|exists:years,id',
            'post_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,webp|max:2048',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)
                ->withInput();
        }
        try {
            $data = $validator->validated();
            if ($request->hasFile('image')) {
                if ($newsRoomRow->image) {
                    $this->deleteImage($newsRoomRow->image, 'news-room');
                }
                $data['image'] = $this->processAndStoreImage(
                    $request->file('image'), 
                    $data['title'], 
                    public_path('upload/news-room')
                );
            }
           
            $newsRoomRow->update([
                'new_and_media_category_id' => $request->news_media_title,
                'title' => $request->news_media_content,
                'image' => $imageName,
                'year_id' => $imageName,
                'location' => $imageName,
                'content' => $imageName,
                'post_date' => $imageName,
                'meta_title' => $imageName,
                'meta_description' => $imageName,
                'status' => $imageName,
            ]);           
        //    // return redirect()->route('manage-news-media.index'?newsMediaId=$data['news_media_categories'])
        //         ->with('success', 'News Room updated successfully');
                
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    protected function deleteImage($filename, $folder)
    {
        $path = public_path("upload/{$folder}/{$filename}");
        if (file_exists($path)) {
            unlink($path);
        }
    }

}
