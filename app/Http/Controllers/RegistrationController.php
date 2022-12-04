<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    public function create()
    {
        $cus_id = Session::get('cus_id');
        if (!isset($cus_id)) {
            return view('account.login.register');
        } else {
            return redirect()->to('/account/library')->send();
        }
    }
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'email' => 'required|unique:tbl_account|max:255',

            ],
            [
                'email.unique' => 'Email đã được sử dụng, hãy thử lại bằng email khác!',
                'email.max' => 'Email tối đa 255 kí tự!',
            ]
        );

        $pass  = md5($request->password);
        $re_pass = md5($request->re_password);
        $capt = $request->capt;
        $captcha = $request->captcha;
        if ($pass === $re_pass) {
            if ($capt === $captcha) {
                $register = new Account();
                $register->email = $data['email'];
                $register->password = $pass;
                $register->username = 'User'.date('mdYhis');
                $register->save();

                $result = Account::where('email', $data['email'])->where('password', $pass)->first();
                Session::put('cus_email', $result->email);
                Session::put('cus_id', $result->id);
                Session::put('cus_name', $result->username);
                return redirect()->to('/account/library')->with('msg', 'Xin chào ' . $result->username . '!');
            } else {
                return redirect()->to('/account/register')->with('error', 'Captcha không trùng khớp!');
            }
        } else {
            return redirect()->to('/account/register')->with('error', 'Mật khẩu không trùng khớp!');
        }
    }
}
