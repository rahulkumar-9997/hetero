<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
class CacheController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:clear cache')->only('clearCache');
    }

   public function clearCache()
    {
        try {
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            Artisan::call('event:clear');
            Artisan::call('optimize:clear');
            return back()->with('success', 'All caches cleared successfully.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Failed to clear caches.');
        }
    }
}
