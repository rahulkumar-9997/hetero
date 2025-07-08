<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsMediaCategoryController extends Controller
{
    public function index(){
        return view('backend.pages.new-media-category.index');
    }
}
