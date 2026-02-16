<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;
use App\Models\NewsRoom;
use App\Models\Year;
use App\Models\MedicineContent;
use App\Models\MedicineCategories;
class FrontHomeController extends Controller
{
    public function home(){
       $data['banners'] = Banner::with(['medicines' => function($q) {
            $q->select('id', 'banner_id', 'title', 'link');
        }])
        ->select('id', 'banner_heading_name', 'banner_content', 'banner_link', 'banner_desktop_img', 'banner_mobile_img')
        ->orderBy('id', 'desc')
        ->take(5)
        ->get();

        $data['newsroom'] = NewsRoom::select('title', 'slug', 'post_date', 'image')
        ->orderBy('id', 'asc')
        ->take(3)
        ->get();
        $data['medicineCategories'] = MedicineCategories::select('title', 'slug', 'image', 'content')
        ->orderBy('id', 'asc')
        ->take(9)
        ->get();
        //return response()->json($data['banners']);
        return view('frontend.index', compact('data'));
    }

    public function newsList()
    {
        $years = Year::with(['newsRooms' => function($query) {
        $query->orderBy('post_date', 'desc');
        }])
        ->whereHas('newsRooms')
        ->orderBy('title', 'desc') 
        ->get();
        //return response()->json($years);
        return view('frontend.pages.news.news-list', compact('years'));
    }

    public function newsDetails($slug)
    {
        $newsRoom = NewsRoom::with('newsMediaCategory')
        ->where('slug', $slug)
        ->firstOrFail();
        //return response()->json($newsRoom);
        return view('frontend.pages.news.news-details', compact('newsRoom'));
    }

    public function medicineList()
    {   
        $medicineCategories = MedicineCategories::orderBy('id', 'desc')
            ->where('status', 1)
            ->get();            
        //return response()->json($medicineContents);
        return view('frontend.pages.medicine.medicine-list', compact('medicineCategories'));
    }

    public function medicineCategoryAjax(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:medicine_categories,id'
        ]);
        $medicineContents = MedicineContent::where('status', 1)
            ->where('medicine_category_id', $request->id)
            ->with(['MedicineCategory' => function($query) {
                $query->where('status', 1);
            }])
            ->orderBy('title')
            ->get()
            ->filter(function($content) {
                return $content->MedicineCategory !== null;
        });

        try {
            if($medicineContents->isEmpty())
            {
                $html = '<div class="row"><div class="col-lg-10"><div class="text-info">No medicines found for this category.</div></div></div>';
            } 
            else
            {
                $html = view('frontend.pages.medicine.partials.ajax-medicine-list', [
                'medicineContents' => $medicineContents
                ])->render();
            }
            
            return response()->json([
                'success' => true,
                'html' => $html
            ]);
            
        } catch (\Exception $e) {
            Log::error('View Rendering Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading content'
            ], 500);
        }
    }

    public function medicineDetails($slug)
    {   
        $medicineContent = MedicineContent::where('status', 1)
            ->where('slug', $slug)
            ->with(['MedicineCategory'])
        ->firstOrFail();
        //return response()->json($medicineContent);
        return view('frontend.pages.medicine.medicine-details', compact('medicineContent'));
    }

    public function medicineCateWiseList($slug)
    {
        try {
            $medicineCategory = MedicineCategories::where('slug', $slug)->firstOrFail();
            $medicineContent = MedicineContent::where('status', 1)
                ->where('medicine_category_id', $medicineCategory->id)
                ->get();
            if ($medicineContent->isEmpty()) {
                return view('frontend.pages.medicine.medicine-list-cate-wise', [
                    'medicineContent' => $medicineContent,
                    'medicineCategory' => $medicineCategory,
                    'message' => 'No medicines found in this category.'
                ]);
            }
            return view('frontend.pages.medicine.medicine-list-cate-wise', compact('medicineContent', 'medicineCategory'));
        } catch (\Exception $e) {
            Log::error('Error fetching medicine category list: ' . $e->getMessage());
            return abort(404, 'Category not found');
        }
    }
    
    public function contactUsPage()
    {
        return view('frontend.pages.contact-us.index');
    }

    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img('flat')]);
    }

    public function contactFormSubmit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'nullable|string|max:1000',
            'captcha' => 'required|captcha',
        ], [
            'captcha.required' => 'Введите код с картинки',
            'captcha.captcha'  => 'Неверный код с картинки',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $validated = $validator->validated();

        $data = [
            'name'    => $validated['name'],
            'email'   => $validated['email'] ?? null,
            'phone'   => $validated['phone'] ?? null,
            'message' => $validated['message'] ?? null,
        ];

        try {
            Mail::to('rahulkumarmauray464@gmail.com')->send(new EnquiryMail($data));
        } catch (\Exception $e) {
            Log::error('Failed to send enquiry email: ' . $e->getMessage());
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Your enquiry form submitted successfully. Our team will contact you soon.',
        ]);
    }


}
