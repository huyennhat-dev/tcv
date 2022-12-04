<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

use Illuminate\Support\Facades\Session;

class CustomLoginController extends Controller
{
    public function check_login()
    {
        $cus_id = Session::get('cus_id');
        // if (!isset($cus_id)) {
        //     return redirect()->to('/account/login')->send();
        //     die();
        // } else {
        //     return redirect()->to('/account/library')->send();
        // }
    }
    public function create()
    {
        $cus_id = Session::get('cus_id');
        if (!isset($cus_id)) {
            return view('account.login.login');
        } else {
            return redirect()->to('/account/library')->send();
        }
    }
    public function login(Request $request)
    {
        $current_page = Session::get('current_page');

        $email = $request->email;
        $pass  = md5($request->password);
        $capt = $request->capt;
        $captcha = $request->captcha;


        if ($capt === $captcha) {
            $result = Account::where('email', $email)->where('password', $pass)->first();
            if ($result == true) {
                Session::put('cus_id', $result->id);
                Session::put('cus_name', $result->username);
                Session::put('cus_email', $result->email);
                Session::put('cus_avatar', $result->avatar);
                return redirect()->to($current_page);
            } else {
                return redirect()->to('/account/login')->with('error', 'Mật khẩu hoặc tài khoản không chính xác!');
            }
        } else {
            return redirect()->to('/account/login')->with('error', 'Captcha không trùng khớp!');
        }
    }
    public function log_out(Request $request)
    {
        $this->check_login();
        $current_page = Session::get('current_page');

        // Xóa tất cả các session...
        $request->session()->flush();
        return redirect()->to($current_page);
    }
}
