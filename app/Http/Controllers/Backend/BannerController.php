<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Banner;
use App\Models\BannerMedicine;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::with('medicines')->orderBy('id', 'desc')->get();
        return view('backend.pages.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('backend.pages.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'banner_heading_name'   => 'nullable|string|max:255',
            'banner_content'        => 'nullable|string',
            'banner_link'           => 'nullable|url',
            'banner_desktop_img'    => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_mobile_img'     => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'medicine_title'        => 'nullable|array',
            'medicine_title.*'      => 'nullable|string|max:255',
            'medicine_link'         => 'nullable|array',
            'medicine_link.*'       => 'nullable|url',
        ]);

        DB::beginTransaction();
        try {
            $destinationPath = public_path('upload/banner');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $desktopImageName = null;
            if ($request->hasFile('banner_desktop_img')) {
                $desktopImage = $request->file('banner_desktop_img');
                $uniqueTimestampDesktop = round(microtime(true) * 1000);
                $desktopImageName = 'desktop-' . $uniqueTimestampDesktop . '.webp';

                $img = Image::make($desktopImage->getRealPath());
                $img->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save($destinationPath . '/' . $desktopImageName);
            }
            $mobileImageName = null;
            if ($request->hasFile('banner_mobile_img')) {
                $mobileImage = $request->file('banner_mobile_img');
                $uniqueTimestampMobile = round(microtime(true) * 1000);
                $mobileImageName = 'mobile-' . $uniqueTimestampMobile . '.webp';
                $img = Image::make($mobileImage->getRealPath());
                $img->resize(768, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save($destinationPath . '/' . $mobileImageName);
            }
            $banner = Banner::create([
                'banner_heading_name' => $request->banner_heading_name,
                'banner_content'      => $request->banner_content,
                'banner_link'         => $request->banner_link,
                'banner_desktop_img'  => $desktopImageName,
                'banner_mobile_img'   => $mobileImageName,
            ]);
            if ($request->has('medicine_title') && is_array($request->medicine_title)) {
                foreach ($request->medicine_title as $key => $title) {
                    if (!empty($title)) {
                        BannerMedicine::create([
                            'banner_id' => $banner->id,
                            'title'     => $title,
                            'link'      => $request->medicine_link[$key] ?? null,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('manage-banner.index')->with('success', 'Banner created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner creation failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to create banner. Please try again.');
        }
    }



    public function edit($id)
    {
        $banner = Banner::with('medicines')->findOrFail($id);
        return view('backend.pages.banner.edit', compact('banner'));
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::with('medicines')->findOrFail($id);
        $request->validate([
            'banner_heading_name' => 'nullable|string|max:255',
            'banner_content'      => 'nullable|string',
            'banner_link'         => 'nullable|url',
            'banner_desktop_img'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_mobile_img'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'medicine_title'      => 'nullable|array|max:3',
            'medicine_title.*'    => 'nullable|string|max:255',
            'medicine_link'       => 'nullable|array',
            'medicine_link.*'     => 'nullable|url',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'banner_heading_name' => $request->banner_heading_name,
                'banner_content'      => $request->banner_content,
                'banner_link'         => $request->banner_link,
            ];
            $destinationPath = public_path('upload/banner');
            if ($request->hasFile('banner_desktop_img')) {
                if ($banner->banner_desktop_img && file_exists($destinationPath . '/' . $banner->banner_desktop_img)) {
                    unlink($destinationPath . '/' . $banner->banner_desktop_img);
                }
                $uniqueTimestampDesktop = round(microtime(true) * 1000);
                $desktopImage = $request->file('banner_desktop_img');
                $desktopImageName = 'desktop-' . $uniqueTimestampDesktop . '.webp';
                $img = Image::make($desktopImage->getRealPath());
                $img->resize(1920, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save($destinationPath . '/' . $desktopImageName);

                $data['banner_desktop_img'] = $desktopImageName;
            }
            if ($request->hasFile('banner_mobile_img')) {
                if ($banner->banner_mobile_img && file_exists($destinationPath . '/' . $banner->banner_mobile_img)) {
                    unlink($destinationPath . '/' . $banner->banner_mobile_img);
                }
                $uniqueTimestampMobile = round(microtime(true) * 1000);
                $mobileImage = $request->file('banner_mobile_img');
                $mobileImageName = 'mobile-' . $uniqueTimestampMobile . '.webp';
                $img = Image::make($mobileImage->getRealPath());
                $img->resize(768, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save($destinationPath . '/' . $mobileImageName);

                $data['banner_mobile_img'] = $mobileImageName;
            }
            $banner->update($data);
            $banner->medicines()->delete();
            if ($request->has('medicine_title') && is_array($request->medicine_title)) {
                foreach ($request->medicine_title as $key => $title) {
                    if (!empty($title)) {
                        BannerMedicine::create([
                            'banner_id' => $banner->id,
                            'title'     => $title,
                            'link'      => $request->medicine_link[$key] ?? null,
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('manage-banner.index')->with('success', 'Banner updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner update failed: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Failed to update banner. Please try again.');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $banner = Banner::with('medicines')->findOrFail($id);
            $destinationPath = public_path('upload/banner');
            foreach (['banner_desktop_img', 'banner_mobile_img'] as $imgField) {
                $imgPath = $destinationPath . '/' . $banner->$imgField;
                if ($banner->$imgField && File::exists($imgPath)) {
                    File::delete($imgPath);
                }
            }
            if ($banner->medicines()->count() > 0) {
                $banner->medicines()->delete();
            }
            $banner->delete();
            DB::commit();
            return redirect()->route('manage-banner.index')->with('success', 'Banner deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Banner deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to delete banner. Please try again.');
        }
    }

}
