<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNewsMediaRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Models\NewsAndMediaCategory;
use App\Models\Year;
use App\Models\PressKit;
use App\Models\NewsRoom;
use App\Models\FeaturedStory;

class NewsMediaController extends Controller
{
    public function index(){
        $featuredStories = FeaturedStory::with('newsMediaCategory')->orderBy('id', 'desc')->get();
        $newsMediaCategories = NewsAndMediaCategory::orderBy('id', 'desc')->get();
        return view('backend.pages.news-media.index', compact('newsMediaCategories', 'featuredStories'));
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
        return NewsRoom::create([
            'new_and_media_category_id' => $categoryId,
            'title' => $data['title'],
            'slug' => $slug,
            'year_id' => $data['years'],
            'location' => $data['location'],
            'content' => $data['content'],
            'post_date' => now(),
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

        $imagePath = $this->processAndStoreImage($data['image'], $data['title']);
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

    protected function processAndStoreImage($imageFile, $title)
    {
        $destinationPath = public_path('upload/press-kit/image');
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }
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

}
