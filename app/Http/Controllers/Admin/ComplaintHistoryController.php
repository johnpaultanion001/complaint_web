<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ComplaintHistory;
use Illuminate\Http\Request;
use Validator;

class ComplaintHistoryController extends Controller
{
   
    public function index()
    {
        $complaints = ComplaintHistory::latest()->get();
        return view('admin.complaints_history', compact('complaints')); 
    }
    
    public function store(Request $request)
    {
        $validated =  Validator::make($request->all(), [
            'name_of_complainant' => ['required'],
            'grade' => ['required'],
            'section' => ['required'],
            'action_taken' => ['required'],
            'date_of_complaint' => ['required'],
            'name_of_complained' => ['required'],
            'complaint' => ['required'],

        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        ComplaintHistory::create([
            'name_of_complainant'          =>  $request->input('name_of_complainant'),
            'grade'   =>  $request->input('grade'),
            'section'   =>  $request->input('section'),
            'action_taken'   =>  $request->input('action_taken'),
            'date_of_complaint'   =>  $request->input('date_of_complaint'),
            'name_of_complained'   =>  $request->input('name_of_complained'),
            'complaint'   =>  $request->input('complaint'),
        ]);
        
      
        return response()->json(['success' => 'Successfully Added Record.']);
    }

   
    public function edit(ComplaintHistory $complaint_history)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $complaint_history]);
        }
    }

   
    public function update(Request $request, ComplaintHistory $complaint_history)
    {
        $validated =  Validator::make($request->all(), [
            'name_of_complainant' => ['required'],
            'grade' => ['required'],
            'section' => ['required'],
            'action_taken' => ['required'],
            'date_of_complaint' => ['required'],
            'name_of_complained' => ['required'],
            'complaint' => ['required'],

        ]);

        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        $complaint_history->update([
            'name_of_complainant'          =>  $request->input('name_of_complainant'),
            'grade'   =>  $request->input('grade'),
            'section'   =>  $request->input('section'),
            'action_taken'   =>  $request->input('action_taken'),
            'date_of_complaint'   =>  $request->input('date_of_complaint'),
            'name_of_complained'   =>  $request->input('name_of_complained'),
            'complaint'   =>  $request->input('complaint'),
        ]);
        
      
        return response()->json(['success' => 'Successfully Updated Record.']);
    }

    
    public function destroy(ComplaintHistory $complaint_history)
    {
        $complaint_history->delete();
        return response()->json(['success' => 'Successfully Updated Record.']);
    }
}
