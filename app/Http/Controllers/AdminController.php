<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = session('id');
        if($admin_id){
            return Redirect::to('admin-dashboard');
        }
        else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        $admin_id = session('id');
        if($admin_id){
            return Redirect::to('admin-dashboard');
        }
        return view('admin_login');
    } 
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->email;
        $admin_pass = sha1($request->password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password', $admin_pass)->first();
        if($result){
            $request->session()->put('id', $result->admin_id);
            $request->session()->put('name', $result->admin_name);
            // return Redirect::to('/dashboard');
            return view('admin.dashboard');
        }
        else{
            $request->session()->put('Message', 'Mật khẩu hoặc tài khoản ko chính xác !');
            return Redirect::to('/admin');
        }
    }
    public function log_out(Request $request){
        // $this->AuthLogin();
        $request->session()->put('id', null);
        $request->session()->put('name', null);
        return Redirect::to('/admin');

    }
}
