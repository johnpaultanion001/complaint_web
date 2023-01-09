<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
use File;

class UsersController extends Controller
{

    public function home(){
     
        return view('user.home'); 
    }

    public function index()
    {
        $users = RoleUser::whereIn('role_id',['2'])->get();

        return view('admin.users.users', compact('users'));
    }

    public function status(User $account)
    {
        if($account->isApproved == 1){
            $account->update([
                'isApproved'    => 0
            ]);
        }else{
            $account->update([
                'isApproved'    => 1
            ]);
        }

       
        return response()->json(['success' => 'Updated Successfully.']);
    }
    

    public function changepassword()
    {
        return view('admin.change_password.change_password');

    }
    public function passwordupdate(Request $request , User $user){
        date_default_timezone_set('Asia/Manila');
        $validated =  Validator::make($request->all(), [
            'current_password' => ['required',new MatchOldPassword],
            'new_password' => ['required','min:8'],
            'confirm_password' => ['required','same:new_password'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors' => $validated->errors()]);
        }

        User::find($user->id)->update([
            'password' => Hash::make($request->input('new_password')),
          
        ]);
        return response()->json(['success' => 'Updated Successfully.']);
    }

    public function edit_account(Request $request){
        return view('admin.edit_account.edit_account');
    }

    public function edit_account_update(Request $request, $account){
        if(auth()->user()->roles()->pluck('id')->implode(', ') == 2){
            $validated =  Validator::make($request->all(), [
                'name'             => ['required'],
                'contact_number'   => ['required', 'numeric' ],
                'address'          => ['required'],
                'lat'              => ['required'],
                'lng'              => ['required'],
                'business_permit'  =>  ['mimes:png,jpg,jpeg,svg,bmp,ico', 'max:2040'],
            ]); 

            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }

            $clinic = Clinic::where('id', $account)->first();

            if ($request->file('business_permit')) {
                File::delete(public_path('assets/images/business_permit/'.$clinic->business_permit));
                $imgs = $request->file('business_permit');
                $extension = $imgs->getClientOriginalExtension(); 
                $file_name_to_save = time()."_".auth()->user()->id.".".$extension;
                $imgs->move('assets/images/business_permit/', $file_name_to_save);
                $clinic->business_permit = $file_name_to_save;
            }
           
            $clinic->name = $request->name;
            $clinic->contact_number = $request->contact_number;
            $clinic->address = $request->address;
            $clinic->lat = $request->lat;
            $clinic->lng = $request->lng;
            $clinic->warning_text = $request->warning_text;
            $clinic->save();
        }
        else if(auth()->user()->roles()->pluck('id')->implode(', ') == 3){
            $validated =  Validator::make($request->all(), [
                'name'   => ['required'],
                'contact_number'   => ['required', 'numeric' ],
                'address'   => ['required'],
            ]);
            if ($validated->fails()) {
                return response()->json(['errors' => $validated->errors()]);
            }

            Client::find($account)->update([
                'name'  => $request->input('name'),
                'contact_number'  => $request->input('contact_number'),
                'address'  => $request->input('address'),
            ]);
        }


        return response()->json(['success' => 'Updated Successfully.']);
    }

}
