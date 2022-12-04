<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Mail;
use App\Models\Account;
use App\Models\Book;

class MailController extends Controller
{
    public function check_login()
    {
        $admin_id = Session::get('admin_id');
        if (!isset($admin_id)) {
            return redirect()->to('/admin/login')->send();
            die();
        }
    }
    public function index()
    {
        $this->check_login();
        $mail = Mail::where('receive_id', 0)->orderBy('trangthai', 'ASC')->orderBy('ngaygui', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.mail.index')->with(compact('mail', 'mail_notify', 'approval_notify'));
    }
    public function create($u_id)
    {
        $this->check_login();
        $account = Account::find($u_id);
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.mail.send_form')->with(compact('account', 'mail_notify', 'approval_notify'));
    }
    public function store(Request $request, $u_id)
    {
        $data = $request->validate(
            [
                'noidung' => 'required',
            ],
            [
                'noidung.required' => 'Nội dung truyện không được để trống',
            ]
        );

        $mail = new Mail();
        $mail->send_id = $request->send_id;
        $mail->receive_id = $u_id;
        $mail->noidung = $data['noidung'];
        $mail->trangthai = '0';
        $mail->save();
        return redirect()->back()->with('msg', 'Bạn đã gửi thành công!');
    }

    public function read_mail($mail_id)
    {
        $this->check_login();
        $mail = Mail::find($mail_id);
        if($mail->trangthai != 1){
            $mail->trangthai = 1;
            $mail->save();
        }
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.mail.read_mail')->with(compact('mail', 'mail_notify', 'approval_notify'));
    }
}
