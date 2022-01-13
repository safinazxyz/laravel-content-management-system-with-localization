<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AdminChangePasswordRequest;
use App\Http\Requests\Admin\Auth\AdminLoginRequest;
use App\Http\Requests\Admin\Auth\AdminRegisterRequest;
use App\Http\Requests\Admin\Profile\AdminProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboard(){
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings(){
        Session::put('page','settings');
        $adminDetails = Admin::where('email',
            Auth::guard('admin')->user()->email)->first();
        return View::make('admin.admin_settings.admin_settings', array('adminDetails' => $adminDetails));
    }

    public function checkAdminPassword(Request $request){
        $data = $request->all();
            if(Hash::check($data['current_pwd'],
                Auth::guard('admin')->user()->password)){
                return 'true';
            }else{
                return 'false';
            }
    }

    public function updateAdminPassword(AdminChangePasswordRequest $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if(Hash::check($data['current_password'],
                Auth::guard('admin')->user()->password)){
                if($data['new_pwd']===$data['confirm_new_pwd']){
                    Admin::where('id',
                        Auth::guard('admin')->user()->id)->update(['password'=>
                    bcrypt($data['new_pwd'])]);
                    Session::flash('success_message',trans('validation.updateAdminPassword.success'));
                }else{
                    Session::flash('error_message',trans('validation.updateAdminPassword.errorConfirmPassword'));
                }
            }else{
                Session::flash('error_message',trans('validation.updateAdminPassword.errorCurrentPassword'));
                return redirect()->back();
            }
            return redirect()->back();
        }
    }

    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $rules =[
                     'email' => 'required|email',
                     'password' => 'required|max:100',
            ];
            $this->validate($request,$rules);
           if(Auth::guard('admin')->attempt(['email'=>$data['email'],
               'password'=>$data['password']])){
               $adminStatus = Admin::where(['email' => $data['email']])->first();
               if(value($adminStatus->status)===1){
                   return redirect()->route('admin.dashboard');
               }else{
                   Session::flash('error_message',trans('validation.login.notActive'));
                   return redirect()->back();
               }
           }else{
               Session::flash('error_message',trans('validation.login.invalid'));
               return redirect()->back();
           }
        }
        return view('admin.auth.admin_login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function updateAdminDetails(AdminProfileRequest $request){
        if($request->isMethod('post')){
            $data = $request->all();
            if($request->hasFile('admin_image')){
                $image_tmp = $request->file('admin_image');
                if($image_tmp->isValid()){
                    $exImg = $request['current_admin_image'];
                    $image_path_delete = 'img/admin_img/admin_profile/';
                    if($exImg){
                        if (file_exists($image_path_delete . $exImg)) {
                            unlink($image_path_delete . $exImg);
                        }
                    }
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath='img/admin_img/admin_profile/'.$imageName;
                    Image::make($image_tmp)->resize(400, 400)->save($imagePath);
                }else if(!empty($data['current_admin_image'])){
                    $imageName = $data['current_admin_image'];
                }else{
                    $imageName="";
                }
            }else{
                $imageName="";
            }
            Admin::where('id',
                Auth::guard('admin')->user()->id)->update(
                [
                    'name'=> $data['admin_name'],
                    'mobile'=> $data['admin_mobile'],
                    'image'=> $imageName
                ]);
            Session::flash('success_message',trans('validation.updateAdminDetails.success'));
            return redirect()->back();
        }
    }

    public function showAdminDetails(){
        Session::put('page','update-admin-details');
        $adminDetails = Admin::where('email',
            Auth::guard('admin')->user()->email)->first();
        return View::make('admin.admin_settings.update_admin_details', array('adminDetails' => $adminDetails));
    }

    public function showAdminUserList(){
        if(strtolower(Auth::guard('admin')->user()->type)==='admin'){
            Session::put('page','show-admin-user-list');
            $adminDetails = Admin::all() ;
            return View::make('admin.admin_settings.admin_users', array('adminDetails' => $adminDetails));
        }else{
            return redirect()->back();
        }
    }

    public function editAdminStatus(Request $request){
        if(strtolower(Auth::guard('admin')->user()->type)==='admin'){
            $newStatus=$request['admin_status_checkbox'];
            if($newStatus==='on'){
                $newStatus=1;
            }
            if($newStatus===null){
                $newStatus=0;
            }
            if(strtolower($request['admin_type'])!=='admin'){
                Admin::where('id',$request['admin_id'])->update(
                    [
                        'status'=> $newStatus,
                    ]);
            }
        }
        return redirect()->back();
    }

    public function deleteSubAdmin($id = null)
    {
        if(strtolower(Auth::guard('admin')->user()->type)==='admin'){
            if (!empty($id)) {
                $subAdminImage = Admin::where(['id' => $id])->first();
                if(strtolower($subAdminImage->type)!=='admin'){
                    $image_path_delete = 'img/admin_img/admin_profile/';
                    if(!empty($subAdminImage->image)){
                        if (file_exists($image_path_delete . $subAdminImage->image)) {
                            unlink($image_path_delete . $subAdminImage->image);
                        }
                    }
                    Admin::where(['id' => $id])->delete();
                }
            }
        }
        return redirect()->back();
    }

    public function adminRegisterPage(){
        return view('admin.auth.admin_register');
    }

    public function adminRegister(AdminRegisterRequest $request){
        Admin::create([
            'name' => $request['full_name'],
            'type' => 'sub-admin',
            'mobile' => '',
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'image'=>'',
            'status'=>0,
        ]);
        return redirect()->route('admin.login')->with('success_message',trans('auth.register.registered'));
    }
}
