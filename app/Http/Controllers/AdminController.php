<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use App\Models\Admin;
use App\Models\Book;
use App\Models\BookComment;
use App\Models\Sect;
use App\Models\World;
use App\Models\Category;
use App\Models\Personality;
use App\Models\Chapter;
use App\Models\ChapterComment;
use App\Models\Rating;
use App\Models\Mail;

class AdminController extends Controller
{

    public function login(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $capt = $request->capt;
        $inputcapt = $request->captcha;

        if ($capt === $inputcapt) {
            $result = Admin::where('email', $email)->where('password', $password)->first();
            if ($result == true) {
                Session::put('admin_email', $result->email);
                Session::put('admin_id', $result->id);
                Session::put('admin_name', $result->username);
                return redirect()->to('/admin/home')->with('msg', 'Xin chào Admin');
            } else {
                return redirect()->to('/admin/login')->with('login_fail', 'Mật khẩu hoặc tài khoản không chính xác!');
            }
        } else {
            return redirect()->to('/admin/login')->with('login_fail', 'Captcha không đúng, hãy thử lại!');
        }
    }
    public function check_login()
    {
        $admin_id = Session::get('admin_id');
        if (!isset($admin_id)) {
            return redirect()->to('/admin/login')->send();
            die();
        }
    }
    public function show_dashboard()
    {
        $this->check_login();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();

        return view('admin.home.home')->with(compact('mail_notify', 'approval_notify'));
    }
    public function view_login()
    {
        return view('admin.admin_login');
    }
    public function log_out(Request $request)
    {
        $this->check_login();
        // Xóa tất cả các session...
        $request->session()->flush();
        return redirect()->to('/admin/login');
    }
    public function show_approval()
    {
        $this->check_login();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();

        return view('admin.approval.approval')->with(compact('mail_notify', 'approval_notify'));
    }

    public function update_approval(Request $request)
    {
        $truyen_id = $request->truyen_id;
        $truyen = Book::find($truyen_id);
        $chapter = Chapter::where('truyen_id', $truyen_id)->get();
        $rating = Rating::where('truyen_id', $truyen_id)->get();
        if (count($chapter)>0) {
            for ($i = 0; $i <= count($chapter) - 1; $i++) {
                $chapter[$i]->trangthai = 1;
                $chapter[$i]->save();
            }
        }
        if(count($rating)>0){
             for ($i = 0; $i <= count($rating) - 1; $i++) {
               $rating[$i]->trangthai = 1;
               $rating[$i]->save();
             }
        }
        $truyen->trangthai = 1;
        $truyen->save();
        
    }
    public function delete_approval(Request $request)
    {
        $this->check_login();
        $truyen_id = $request->truyen_id;
        $truyen = Book::find($truyen_id);
        $bookComment = BookComment::where('truyen_id', $truyen_id);
        $chapComment = ChapterComment::where('truyen_id', $truyen_id);
        $chapter = Chapter::where('truyen_id', $truyen_id);
        $rating = Rating::where('truyen_id', $truyen_id);

        $path = 'public/uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }

        $chapter->delete();
        $rating->delete();
        $bookComment->delete();
        $chapComment->delete();
        $truyen->delete();
    }
    public function load_approval(Request $request)
    {
        $truyen = Book::where('trangthai', 0)->orderBy('id', 'DESC')->get();
        $output = '';
        $output .= '<table class="table table-responsive manage-u-table" id="tbl_admin">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class=" w-30 fw-500 text-center">STT</th>';
        $output .= '<th class=" w-100px ">Ảnh Bìa</th>';
        $output .= '<th class=" w-500 fw-500">Tên Truyện</th>';
        $output .= '<th class=" w-150 fw-500">Người Đăng</th>';
        $output .= '<th class=" w-150 fw-500">Ngày Đăng</th>';
        $output .= '<th class=" w-150 fw-500">Số Chương</th>';
        $output .= '<th class=" w-150 fw-500">Thao Tác</th>';
        $output .= ' </tr>';
        $output .= '</thead>';
        $output .= '<tbody >';
        if (count($truyen)) {
            foreach ($truyen as $key => $val) {

                $chapter[$key] = Chapter::where('truyen_id', $truyen[$key]->id)->get();
                $count_chap[$key] = count($chapter[$key]);

                $output .= '<tr>';
                $output .= '<td class="text-center">' . $key + 1 . '</td>';
                $output .= '<td>';
                $output .= '<img width="50" src="' . url('public/uploads/truyen/') . '/' . $val->hinhanh . '" alt="">';
                $output .= '</td>';
                $output .= '<td>';
                $output .= '<a href="' . url('admin/approval/' . $val->id . '/show') . '" class="text-primary">' . $val->tentruyen . '</a>';
                $output .= '</td>';
                $output .= '<td>';
                $output .= '<a href="' . url('/admin/account/' . $val->nguoidang_id) . '" class="text-primary">' . $val->nguoidang->username . '</a>';
                $output .= '</td>';
                $output .= '<td>' . $val->ngaydang . '</td>';
                $output .= '<td>' . $count_chap[$key] . '</td>';
                $output .= '<td>';
                $output .= '<div class="d-flex">';
                $output .= '<button type="button" data-truyen_id="' . $val->id . '" id="" class="btn btn-success approval_btn btn-xs mr-2">';
                $output .= 'Duyệt';
                $output .= '</button>';
                $output .= '<button type="button" data-truyen_id="' . $val->id . '" class="btn btn-danger btn-xs delete_approval_btn">';
                $output .= 'Xóa';
                $output .= '</button>';
                $output .= '</div>';
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr>';
            $output .= '<td class="text-center" colspan="7"><strong>Không có truyện</strong></td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
        $output .= '<script>';
        $output .= '$(document).ready(function() {';
        $output .= '$("#tbl_admin").DataTable()';
        $output .= '})';
        $output .= '</script>';
        
        echo $output;
    }
    public function show_truyen($truyen_id)
    {
        $this->check_login();

        $truyen = Book::find($truyen_id);

        $theloai = Category::orderBy('id', 'ASC')->get();
        $thegioi = World::orderBy('id', 'ASC')->get();
        $tinhcach = Personality::orderBy('id', 'ASC')->get();
        $luuphai = Sect::orderBy('id', 'ASC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();

        return view('admin.approval.book_detail')->with(compact('truyen', 'theloai', 'luuphai', 'tinhcach', 'thegioi', 'mail_notify', 'approval_notify'));
    }

    public function show_solved()
    {
        $this->check_login();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();

        return view('admin.solved.solved')->with(compact('mail_notify', 'approval_notify'));
    }

    public function update_solved(Request $request)
    {
        $truyen_id = $request->truyen_id;
        $truyen = Book::find($truyen_id);
        $chapter = Chapter::with('truyen')->where('truyen_id', $truyen_id)->get();
        $rating = Rating::where('truyen_id', $truyen_id)->get();
        $truyen->trangthai = '0';
        if ($chapter) {
            for ($i = 0; $i <= count($chapter) - 1; $i++) {
                $chapter[$i]->trangthai = 0;
                $chapter[$i]->save();
            }
        }
         if(count($rating)>0){
             for ($i = 0; $i <= count($rating) - 1; $i++) {
               $rating[$i]->trangthai = 0;
               $rating[$i]->save();
             }
        }
        $truyen->save();
    }
    public function delete_solved(Request $request)
    {
        $this->check_login();
        $truyen_id = $request->truyen_id;
        $truyen = Book::find($truyen_id);
        $bookComment = BookComment::where('truyen_id', $truyen_id);
        $chapComment = ChapterComment::where('truyen_id', $truyen_id);
        $chapter = Chapter::where('truyen_id', $truyen_id);
        $rating = Rating::where('truyen_id', $truyen_id);

        $path = 'public/uploads/truyen/' . $truyen->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        $chapter->delete();
        $rating->delete();
        $bookComment->delete();
        $chapComment->delete();
        $truyen->delete();
    }
    public function load_solved(Request $request)
    {
        $truyen = Book::where('trangthai', 1)->orderBy('id', 'DESC')->get();
        $output = '';
        $output .= '<table class="table table-responsive manage-u-table" id="tbl_admin">';
        $output .= '<thead>';
        $output .= '<tr>';
        $output .= '<th class=" w-30 fw-500 text-center">STT</th>';
        $output .= '<th class=" w-100px ">Ảnh Bìa</th>';
        $output .= '<th class=" w-500 fw-500">Tên Truyện</th>';
        $output .= '<th class=" w-150 fw-500">Người Đăng</th>';
        $output .= '<th class=" w-150 fw-500">Ngày Đăng</th>';
        $output .= '<th class=" w-150 fw-500">Số Chương</th>';
        $output .= '<th class=" w-150 fw-500">Thao Tác</th>';
        $output .= ' </tr>';
        $output .= '</thead>';
        $output .= '<tbody >';
        
        if (count($truyen)) {
            foreach ($truyen as $key => $val) {
                
                $chapter[$key] = Chapter::where('truyen_id', $truyen[$key]->id)->get();
                $count_chap[$key] = count($chapter[$key]);

                $output .= '<tr>';
                $output .= '<td class="text-center">' . $key + 1 . '</td>';
                $output .= '<td>';
                $output .= '<img width="50" src="' . url('public/uploads/truyen/') . '/' . $val->hinhanh . '" alt="">';
                $output .= '</td>';
                $output .= '<td>';
                $output .= '<a href="' . url('admin/solved/' . $val->id . '/show') . '" class="text-primary">' . $val->tentruyen . '</a>';
                $output .= '</td>';
                $output .= '<td>';
                $output .= '<a href="' . url('/admin/account/' . $val->nguoidang_id) . '" class="text-primary">' . $val->nguoidang->username . '</a>';
                $output .= '</td>';
                $output .= '<td>' . $val->ngaydang . '</td>';
                $output .= '<td>' . $count_chap[$key] . '</td>';
                $output .= '<td>';
                $output .= '<div class="d-flex">';
                $output .= '<button type="button" data-truyen_id="' . $val->id . '" id="" class="btn btn-success solved_btn btn-xs mr-2">';
                $output .= 'Bỏ Duyệt';
                $output .= '</button>';
                $output .= '<button type="button" data-truyen_id="' . $val->id . '" class="btn btn-danger btn-xs delete_solved_btn" >';
                $output .= 'Xóa';
                $output .= '</button>';
                $output .= '</div>';
                $output .= '</td>';
                $output .= '</tr>';
            }
        } else {
            $output .= '<tr>';
            $output .= '<td class="text-center" colspan="7"><strong>Không có truyện</strong></td>';
            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';
        $output .= '<script>';
        $output .= '$(document).ready(function() {';
        $output .= '$("#tbl_admin").DataTable()';
        $output .= '})';
        $output .= '</script>';
        
        echo $output;
    }
    public function show_truyen_2($truyen_id)
    {
        $this->check_login();
        $truyen = Book::find($truyen_id);
        $theloai = Category::orderBy('id', 'ASC')->get();
        $thegioi = World::orderBy('id', 'ASC')->get();
        $tinhcach = Personality::orderBy('id', 'ASC')->get();
        $luuphai = Sect::orderBy('id', 'ASC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();

        return view('admin.solved.book_detail')->with(compact('truyen', 'theloai', 'luuphai', 'tinhcach', 'thegioi', 'mail_notify', 'approval_notify'));
    }

    public function listaccount()
    {
        $this->check_login();
        $account = Account::select('*')->orderBy('id', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        
        if ($account) {
            for ($i = 0; $i <= count($account) - 1; $i++) {
                $book[$i] = Book::where('nguoidang_id', $account[$i]->id)->get();
                $count_book[$i] = count($book[$i]);
                for($j = 0; $j<=$count_book[$i] - 1; $j++ ){
                    $chap[$i][$j] = Chapter::where('truyen_id', $book[$i][$j]->id)->get();
                    $count_chap[$i][$j] = count($chap[$i][$j]);
                }
            }
        }
        return view('admin.account.list_account')->with(compact('account', 'mail_notify', 'approval_notify', 'count_book', 'count_chap'));
    }
    public function detail_account($id)
    {
        $this->check_login();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        
        $account = Account::find($id);
        $truyendangra = Book::where('nguoidang_id', $id)->where('tinhtrang', 0)->orderBy('id', 'DESC')->paginate(7);
        $truyenhoanthanh = Book::where('nguoidang_id', $id)->where('tinhtrang', 1)->orderBy('id', 'DESC')->paginate(7);
        
        $book = Book::where('nguoidang_id', $id)->get();
        
        if (count($book)>0) {
            $count_book = count($book);
            for ($i = 0; $i <= $count_book - 1; $i++) {
                $chapter[$i] = Chapter::where('truyen_id', $book[$i]->id)->get();
                $count_chap[$i] = count($chapter[$i]);
            }
            $total_chap =  array_sum($count_chap);
        }else{
            $count_book = '0';
            $total_chap= 0;
        }
        return view('admin.account.detail_account')->with(compact(
            'account',
            'mail_notify',
            'approval_notify',
            'truyendangra',
            'truyenhoanthanh',
            'count_book',
            'total_chap'
        ));
    }
}
