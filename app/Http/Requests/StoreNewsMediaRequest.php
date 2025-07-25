<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsMediaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'news_media_categories' => 'required|exists:news_and_media_categories,id',
            'is_active' => 'nullable|boolean',
            'media-action-type' => 'required|string|max:255',
        ];
        $mediaType = $this->input('media-action-type');
        switch ($mediaType) {
            case 'featured-stories':
                $rules = array_merge($rules, [
                    'title' => 'required|string|max:255',
                    'subtitle' => 'nullable|string|max:255',
                    'content' => 'required|string',
                    'meta_title' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:500',
                ]);
                break;
            case 'newsroom':
                $rules = array_merge($rules, [
                    'title' => 'required|string|max:255',
                    'years' => 'nullable|exists:years,id',
                    'post_date' => 'nullable|date',
                    'location' => 'nullable|string|max:255',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                    'content' => 'required|string',
                    'meta_title' => 'nullable|string|max:255',
                    'meta_description' => 'nullable|string|max:500',
                ]);
                break;

            case 'press-kit':
                $rules = array_merge($rules, [
                    'title' => 'required|string|max:255',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'pdf_file' => 'required|file|mimes:pdf|max:5120',
                ]);
                break;
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'news_media_categories.required' => 'Please select a news and media category',
            'title.required' => 'The title field is required',
            'content.required' => 'The content field is required',
            'years.required' => 'Please select a year',
            'location.required' => 'The location field is required',
            'image.required' => 'An image is required',
            'pdf_file.required' => 'A PDF file is required',
            'pdf_file.mimes' => 'The file must be a PDF',
        ];
    }
}