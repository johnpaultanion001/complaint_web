<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Application;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use File;

class OffBoardingController extends Controller
{
    public function offboarding(){
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('user.offboarding'); 
    }

    public function application(Request $request){

        date_default_timezone_set('Asia/Manila');

        if(auth()->user()->application->image != '')
        {
            $validation_image =  ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'];
        }
        else{
            $validation_image =  ['required', 'mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'];
        }

        $validated =  Validator::make($request->all(), [
            'name'   => ['required'],
            'school' => ['required'],
            'image_file' =>  $validation_image,
            'course' => ['required'],
            'contact_number' => ['required', 'string', 'min:8','max:11'],
            'birth_date' => ['required', 'date' , 'before:today'],
            'address' => ['required'],

            'student_advisor' => ['required'],
            'required_hours' => ['required'],
            'schedule' => ['required'],
            'starting_date' => ['required', ],
            'ending_date' => ['required'],
            'consent' => ['accepted'],
            'company_name' => ['required'],
            'company_address' => ['required'],
            'supervisor_name' => ['required'],
            'supervisor_email_address' => ['required'],
            'supervisor_contact_number' => ['required', 'string', 'min:8','max:11'],
            'current_job_title' => ['required'],
            'give_job_titles' => ['required'],

            'checklist1' => ['accepted'],
            'checklist2' => ['accepted'],
            'checklist3' => ['accepted'],
            'checklist4' => ['accepted'],
            'checklist5' => ['accepted'],
            'checklist6' => ['accepted'],
            'checklist7' => ['accepted'],
            'checklist8' => ['accepted'],
            'checklist9' => ['accepted'],
            
        ], ['checklist1.accepted' => 'This checklist must be accepted.',
            'checklist2.accepted' => 'This checklist must be accepted.',
            'checklist3.accepted' => 'This checklist must be accepted.',
            'checklist4.accepted' => 'This checklist must be accepted.',
            'checklist5.accepted' => 'This checklist must be accepted.',
            'checklist6.accepted' => 'This checklist must be accepted.',
            'checklist7.accepted' => 'This checklist must be accepted.',
            'checklist8.accepted' => 'This checklist must be accepted.',
            'checklist9.accepted' => 'This checklist must be accepted.'],);
        

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }
        if($request->file('image_file')){
            $imgs = $request->file('image_file');
            $extension = $imgs->getClientOriginalExtension(); 
            $file_name_to_save = auth()->user()->application->id."_".$request->input('name').".".$extension;
            $imgs->move('assets/applicant_picture/', $file_name_to_save);
        }
        

        Application::where('user_id', auth()->user()->id)->update([
            'status' => 'PENDING',
            'name' => $request->input('name'),
            'school' => $request->input('school'),
            'image' => $file_name_to_save ?? auth()->user()->application->image,
            'course' => $request->input('course'),
            'contact_number' => $request->input('contact_number'),
            'birth_date' => $request->input('birth_date'),
            'address' => $request->input('address'),
            'application_id' => $request->input('application_id'),
            'student_advisor' => $request->input('student_advisor'),
            'advisor_email' => $request->input('advisor_email'),
            'required_hours' => $request->input('required_hours'),
            'schedule' => $request->input('schedule'),
            'starting_date' => $request->input('starting_date'),
            'ending_date' => $request->input('ending_date'),
            'consent' => 1,

            'company_name' => $request->input('company_name'),
            'company_address' => $request->input('company_address'),
            'supervisor_name' => $request->input('supervisor_name'),
            'supervisor_email_address' => $request->input('supervisor_email_address'),
            'supervisor_contact_number' => $request->input('supervisor_contact_number'),
            'current_job_title' => $request->input('current_job_title'),
            'give_job_titles' => $request->input('give_job_titles'),

            'checklist1' => 1,
            'checklist2' => 1,
            'checklist3' => 1,
            'checklist4' => 1,
            'checklist5' => 1,
            'checklist6' => 1,
            'checklist7' => 1,
            'checklist8' => 1,
            'checklist9' => 1,

        ]);

        return response()->json(['success' => 'Saved Successfully.']);

    }
}
