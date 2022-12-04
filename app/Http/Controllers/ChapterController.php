<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Account;
use App\Models\Mail;

use Illuminate\Support\Facades\Session;

class ChapterController extends Controller
{
    public function check_login()
    {
        $cus_id = Session::get('cus_id');
        if (!isset($cus_id)) {
            return redirect()->to('/account/login')->send();
            die();
        }
    }
    public function create($truyen_id)
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');

        $truyen = Book::find($truyen_id);
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.chapter.addChapter')->with(compact('truyen', 'mail_notify'));
    }
    public function store(Request $request)
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');
        $data = $request->validate(
            [
                'tenchuong' => 'required|max:255',
                'noidung' => 'required',
            ],
            [
                'tenchuong.max' => 'Tên chương tối đa 255 kí tự',
                'tenchuong.required' => 'Tên chương không được để trống',
                'noidung.required' => 'Nội dung truyện không được để trống',
            ]
        );

        $chuong = new Chapter();
        $truyen =  Book::find($request->truyen_id);
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $chuong->truyen_id = $request->truyen_id;
        $chuong->tenchuong = trim(ucwords($data['tenchuong']));

        $check = Chapter::where('truyen_id', $request->truyen_id)->orderBy('slug', 'DESC')->first();
        if ($check) {
            $chuong->slug = $check->slug + 1;
        } else {
            $chuong->slug = 1;
        }

        $chuong->noidung = trim($data['noidung']);
        $chuong->trangthai = $truyen->trangthai;
        $chuong->luotdoc = '0';
        $truyen->thoigiancapnhat = date("Y-m-d H:i:s");
        $truyen->sochuong += 1;

        $chuong->save();
        $truyen->save();
        return redirect()->back()->with('msg', 'Bạn đã thêm thành công!');
    }
    public function index($truyen_id)
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');

        $truyen = Book::find($truyen_id);
        $listchapter = Chapter::where('truyen_id', $truyen_id)->orderBy('id', 'ASC')->get();
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.chapter.listChapter')->with(compact('truyen', 'listchapter', 'mail_notify'));
    }
    public function edit($truyen_id, $chap_id)
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');

        $truyen = Book::find($truyen_id);
        $chapter = Chapter::find($chap_id);
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.chapter.editChapter')->with(compact('truyen', 'chapter', 'mail_notify'));
    }
    public function update(Request $request, $truyen_id, $chap_id)
    {
        $this->check_login();
        $data = $request->validate(
            [
                'noidung' => 'required',
            ],
            [
                'noidung.required' => 'Nội dung truyện không được để trống',
            ]
        );

        $chuong = Chapter::find($chap_id);
        $chuong->noidung = $data['noidung'];
        $chuong->save();
        return redirect()->back()->with('msg', 'Bạn đã cập nhật thành công!');
    }
    public function delete($truyen_id, $chap_id)
    {
        $this->check_login();
        $chapter = Chapter::find($chap_id);
        $truyen = Book::find($truyen_id);
        $chapter->delete();
        $check_chapter = Chapter::where('truyen_id', $truyen_id)->get();
        // dd($check_chapter);
        if (count($check_chapter) <= 0) {
            $truyen->trangthai = 0;
            $truyen->sochuong -= 1;
        }
        $truyen->save();
        return redirect()->back()->with('msg', 'Bạn đã xóa nhật thành công!');
    }
}
