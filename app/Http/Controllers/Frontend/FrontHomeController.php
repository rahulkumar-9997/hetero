<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Banner;
use App\Models\NewsRoom;
use App\Models\Year;
class FrontHomeController extends Controller
{
    public function home(){
        $data['banners'] = Banner::select('id', 'banner_heading_name', 'banner_content', 'banner_link', 'banner_desktop_img', 'banner_mobile_img')
        ->orderBy('id', 'desc')
        ->take(5)
        ->get();
        $data['newsroom'] = NewsRoom::select('title', 'slug', 'post_date')
        ->orderBy('id', 'asc')
        ->take(3)
        ->get();
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
}
