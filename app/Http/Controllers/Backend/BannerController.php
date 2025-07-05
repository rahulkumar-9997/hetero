<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function index()
    {
        return view('backend.pages.banner.index');
    }

    public function create()
    {
        return view('backend.pages.banner.create');
    }
}
