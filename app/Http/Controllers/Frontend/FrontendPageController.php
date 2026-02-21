<?php
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Mail\AdverseReactionNotificationMail;
use App\Models\Page;

class FrontendPageController extends Controller
{
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $sidebarData = $page->sidebarMenuFrontend();
        //return response()->json($sidebarData);
        return view('frontend.pages.dynamic-pages.show', [
            'page' => $page,
            'sidebarPages' => $sidebarData['pages'],
            'sidebarTitle' => $sidebarData['title']
        ]);
    }
    
    public function adverseReactionStore(Request $request)
    {
        $validated = $request->validate([
            'person_reporting' => 'required|string',
            'full_name' => 'required|string|max:255',
            'position_work_place' => 'nullable|string',
            'email' => 'required|email|max:255',
            'date_of_message' => 'nullable|string',
            'patient_initials_code' => 'required|string|max:50',
            'weight' => 'nullable|string',
            'age' => 'nullable|string|max:50',
            'gender' => 'nullable|in:Мужской,Женский',
            'pregnancy' => 'nullable|in:Да,Нет',
            'allergy' => 'nullable|in:Да,Нет',
            'drug_name' => 'required|string|max:255',
            'serial' => 'nullable|string|max:100',
            'manufacturer' => 'nullable|string|max:255',
            'dose' => 'nullable|string|max:255',
            'admission_start_date' => 'nullable|string',
            'discontinuation_end_date' => 'nullable|string',
            'description_of_reaction' => 'required|string',
            'start_date_of_nr' => 'nullable|string',
            'nr_termination_date' => 'nullable|string',
            'criteria_for_the_severity' => 'nullable|string',
            'measures_taken' => 'nullable|string',
            'exodus' => 'nullable|string',
            'was_the_discontinuation' => 'nullable|string',
            'was_there_a_recurrence' => 'nullable|string',
            'omt_name' => 'nullable|array',
            'omt_name.*' => 'nullable|string|max:255',
            'omt_serial' => 'nullable|array',
            'omt_serial.*' => 'nullable|string|max:100',
            'omt_manufacturer' => 'nullable|array',
            'omt_manufacturer.*' => 'nullable|string|max:255',
            'omt_dose' => 'nullable|array',
            'omt_dose.*' => 'nullable|string|max:255',
            'omt_date_start' => 'nullable|array',
            'omt_date_start.*' => 'nullable|string',
            'omt_date_end' => 'nullable|array',
            'omt_date_end.*' => 'nullable|string',
        ]);
        try {
            try {
                if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    Mail::to($request->email)->send(new AdverseReactionNotificationMail($validated));
                    Log::info('User email sent successfully to: ' . $request->email);
                } else {
                    Log::warning('Invalid user email format: ' . $request->email);
                }
            } catch (\Exception $e) {
                Log::error('Failed to send email to user: ' . $e->getMessage() . ' | Email: ' . $request->email);
            }
            try {
                Mail::to("rahulkumarmaurya464@gmail.com")->send(new AdverseReactionNotificationMail($validated, 'admin'));
                Log::info('Admin email sent successfully to: rahulkumarmaurya464@gmail.com');
            } catch (\Exception $e) {
                Log::error('Failed to send email to admin: ' . $e->getMessage());
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Adverse reaction report submitted successfully!',
            ]);
        
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'errors' => $e->errors()
            ], 422);
        
        } catch (\Exception $e) {
            Log::error('Critical error in adverse reaction submission: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request.'
            ], 500);
        }   
    }
    
}