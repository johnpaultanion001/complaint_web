<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Mail\ComplaintNotification;
use Illuminate\Support\Facades\Mail;
use Validator;

class ComplaintsController extends Controller
{
    public function index(){
        $complaints = Complaint::latest()->get();
        return view('admin.complaints', compact('complaints')); 
    }

    public function complaint(Complaint $complaint)
    {
        if (request()->ajax()) {
            return response()->json(['result' => $complaint]);
        }
    }

    public function change_status(Request $request, Complaint $complaint){
        date_default_timezone_set('Asia/Manila');

        $emailNotif = [
            'notif_message'     => 'Your complaint has been '. $request->input('status'),
            'note'              => $request->input('msg'),
        ];
        Mail::to($complaint->user->email)
                ->send(new ComplaintNotification($emailNotif));

        $complaint->update([
            'status'   => $request->input('status')
        ]);
        return response()->json(['success' => 'Successfully updated.']);
    }
}
