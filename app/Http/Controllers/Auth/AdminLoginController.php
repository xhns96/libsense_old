<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
           'email' => 'required|string|email',
           'password' => 'required|string|min:8'
        ]);

        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'admin_profile_status'=>'active'])){
            if (Auth::guard('admin')->user()->admin_profile_status == "active"){
                return redirect()->intended(route('admin.dashboard'));
            }
            else{
                return back()->with("admin_profile_status");
            }

        }else{
            return back()->with("admin_profile_status","Ushbu Admin uchun kirishga ruxsat etilmagan!");
//            return redirect()->back()->with("admin_profile_status");
//            return redirect()->back()->with($request->only('email'));
        }
//        return redirect()->back()->with($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('landing_page');
    }
}
