<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Complaint;
use App\Models\ComplaintHistory;
use App\Models\RoleUser;

class AdminController extends Controller
{
    public function home(){
      
        $complaints = Complaint::count();
        $users = RoleUser::whereIn('role_id',['2'])->count();
        $complaints_history = ComplaintHistory::count();

        return view('admin.home' , compact('complaints','users','complaints_history')); 
    }
}
