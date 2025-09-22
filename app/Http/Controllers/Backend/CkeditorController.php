<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $imageFile = $request->file('upload');
            $destinationPath = public_path('upload/ckeditor');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            $safeTitle = Str::slug(pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME));
            $filename = $safeTitle . '-' . uniqid() . '.webp';
            try {
                $img = Image::make($imageFile->getRealPath())->encode('webp', 90);
                $img->save($destinationPath . '/' . $filename);
                $url = asset('upload/ckeditor/' . $filename);
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                if ($CKEditorFuncNum) {
                    return response(
                        "<script>
                        window.parent.CKEDITOR.tools.callFunction({$CKEditorFuncNum}, '{$url}', '');
                    </script>"
                    );
                } else {
                    return response()->json([
                        'uploaded' => 1,
                        'fileName' => $filename,
                        'url' => $url
                    ]);
                }
            } catch (\Exception $e) {
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                if ($CKEditorFuncNum) {
                    return response(
                        "<script>
                        window.parent.CKEDITOR.tools.callFunction({$CKEditorFuncNum}, '', 'Upload failed: {$e->getMessage()}');
                    </script>"
                    );
                } else {
                    return response()->json([
                        'uploaded' => 0,
                        'error' => ['message' => 'Upload failed: ' . $e->getMessage()]
                    ]);
                }
            }
        }
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        if ($CKEditorFuncNum) {
            return response(
                "<script>
                window.parent.CKEDITOR.tools.callFunction({$CKEditorFuncNum}, '', 'No file selected');
            </script>"
            );
        } else {
            return response()->json([
                'uploaded' => 0,
                'error' => ['message' => 'No file uploaded.']
            ]);
        }
    }
}
