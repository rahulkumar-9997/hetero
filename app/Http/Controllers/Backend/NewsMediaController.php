<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NewsAndMediaCategory;

class NewsMediaController extends Controller
{
    public function index(){
        return view('backend.pages.news-media.index');
    }
}
