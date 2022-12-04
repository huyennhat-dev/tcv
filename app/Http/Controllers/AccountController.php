<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\Account;
use App\Models\Rating;
use App\Models\BookComment;
use App\Models\ChapterComment;
use App\Models\Faq;
use App\Models\StaffGuide;
use App\Models\AuthorGuide;
use App\Models\Book;
use App\Models\Chat;
use App\Models\Chapter;
use App\Models\Mail;
use App\Models\TickBook;
use App\Models\ReadingBooks;
use Illuminate\Support\Facades\Redis;

class AccountController extends Controller
{
    public function check_login()
    {
        $cus_id = Session::get('cus_id');
        if (!isset($cus_id)) {
            return redirect()->to('/account/login')->send();
            die();
        }
    }
    public function library()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.library.library')->with(compact('mail_notify'));
    }
    public function load_reading_account(Request $request)
    {
        $cus_id = Session::get('cus_id');
        $dangdoc = ReadingBooks::where('u_id', $cus_id)->orderBy('id', 'DESC')->get();
        $output = '';
        if ($cus_id) {
            if (count($dangdoc) >= 1) {
                foreach ($dangdoc as $key => $val) {

                    $output .= '<tr>';
                    $output .= '<td>';
                    $output .= '<div>';
                    $output .= '<a href="' . url('truyen/') . '/' . $val->truyen->slug . '/chuong-' . $val->chuong->slug . '" class="text-primary webkit-line-clamp-1">' . $val->truyen->tentruyen . '</a>';
                    $output .= '</div>';
                    $output .= '<div class="text-secondary webkit-line-clamp-1"> Đã đọc: ' . $val->chuong->tenchuong . '</div>';
                    $output .= '</td>';
                    $output .= '<td style="line-height: 42px">';
                    $output .= '<a class="border border-danger btn btn-circle del_reading_btn" data-idx="' . $val->id . '" >';
                    $output .= '<i class="ti-trash text-danger"></i>';
                    $output .= '</a>';
                    $output .= '</td>';
                    $output .= '</tr>';
                }
            } else {
                $output .= '<tr>';
                $output .= '<td class="text-center" colspan="2"><strong>Không có truyện</strong></td>';
                $output .= '</tr>';
            }
        }
        echo $output;
    }
    public function load_tickbook_account(Request $request)
    {
        $cus_id = Session::get('cus_id');
        $danhdau = TickBook::where('u_id', $cus_id)->orderBy('id', 'DESC')->get();
        $output = '';
        if ($cus_id) {
            if (count($danhdau) >= 1) {
                foreach ($danhdau as $key => $val) {

                    $output .= '<tr>';
                    $output .= '<td>';
                    $output .= '<div>';
                    $output .= '<a href="' . url('truyen/') . '/' . $val->truyen->slug . '" class="text-primary webkit-line-clamp-1">' . $val->truyen->tentruyen . '</a>';
                    $output .= '</div>';
                    $output .= '</td>';
                    $output .= '<td>';
                    $output .= '<a class="border border-danger btn btn-circle del_tickbook_btn" data-idy="' . $val->id . '" >';
                    $output .= '<i class="ti-trash text-danger"></i>';
                    $output .= '</a>';
                    $output .= '</td>';
                    $output .= '</tr>';
                }
            } else {
                $output .= '<tr>';
                $output .= '<td class="text-center" colspan="2"><strong>Không có truyện</strong></td>';
                $output .= '</tr>';
            }
        }
        echo $output;
    }
    public function del_tickbook_account(Request $request)
    {
        $id = $request->id;
        $truyen = TickBook::find($id);
        $truyen->delete();
    }

    public function load_chat_account(Request $request)
    {
        $cus_id = Session::get('cus_id');

        $chat = Chat::select('*')->orderBy('id', 'ASC')->take(100)->get();
        $output = '';
        if ($cus_id) {
            if (count($chat) >= 1) {
                foreach ($chat as $key => $val) {

                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $date1 =  date("$val->ngaydang");
                    $date2 =   date("Y-m-d H:i:s");

                    $diff = abs(strtotime($date2) - strtotime($date1));
                    $years = number_format(($diff / (365 * 60 * 60 * 24)), 1);
                    $months = number_format(($diff / (30 * 60 * 60 * 24)), 0);
                    $days = number_format(($diff / (60 * 60 * 24)), 0);
                    $hours = number_format(($diff  / (60 * 60)), 0);
                    $minutes = number_format(($diff  / 60), 0);
                    $seconds = number_format(($diff  / 1), 0);
                    if ($diff >= 31536000) {
                        $ngaydang =  $years . ' năm trước';
                    }
                    if ($diff < 31536000 && $diff >= 2592000) {
                        $ngaydang =  $months . ' tháng trước';
                    }
                    if ($diff < 2592000 && $diff >= 86400) {
                        $ngaydang =  $days . ' ngày trước';
                    }
                    if ($diff < 86400 && $diff >= 3600) {
                        $ngaydang =  $hours . ' giờ trước';
                    }
                    if ($diff < 3600 && $diff >= 60) {
                        $ngaydang =  $minutes . ' phút trước';
                    }
                    if ($diff < 60 && $diff > 0) {
                        $ngaydang =  $seconds . ' giây trước';
                    }
                    if ($diff === 0) {
                        $ngaydang =  ' Vừa xong';
                    }

                    $output .= '<div class="direct-chat-messages" >';
                    $output .= '<div class="direct-chat-infos clearfix">';
                    $output .= '<span class="direct-chat-name float-left">' . $val->user->username . '</span>';
                    $output .= '<span class="direct-chat-timestamp float-right">' . $ngaydang . '</span>';
                    $output .= '</div>';
                    $output .= '<img class="direct-chat-img" src="' . url('public/uploads/cus_avt/') . '/' . $val->user->avatar . '" alt="">';
                    $output .= '<div class="direct-chat-text"> ' . $val->noidung . ' </div>';
                    $output .= '</div>';
                }
            }
        }
        echo $output;
    }
    public function send_chat(Request $request)
    {
        $chat = new Chat();

        $chat->u_id =  $request->u_id;
        $chat->noidung = $request->chat_content;
        $chat->save();
    }
    //profile
    public function profile()
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $account = Account::find($cus_id);

        $book = Book::where('nguoidang_id', $cus_id)->get();

        if (count($book) > 0) {
            $count_book = count($book);
            for ($i = 0; $i <= $count_book - 1; $i++) {
                $chapter[$i] = Chapter::where('truyen_id', $book[$i]->id)->get();
                $count_chap[$i] = count($chapter[$i]);
            }
            $total_chap =  array_sum($count_chap);
        } else {
            $count_book = '0';
            $total_chap = 0;
        }
        $truyendangra = Book::where('nguoidang_id', $cus_id)->where('tinhtrang', 0)->orderBy('id', 'DESC')->paginate(7);
        if (count($truyendangra) > 0) {
            $count_truyendangra = count($truyendangra);
            for ($i = 0; $i <= $count_truyendangra - 1; $i++) {
                $truyendangra_chapter[$i] = Chapter::where('truyen_id', $truyendangra[$i]->id)->get();
            }
        } else {
            $truyendangra_chapter = 0;
        }
        $truyenhoanthanh = Book::where('nguoidang_id', $cus_id)->where('tinhtrang', 1)->orderBy('id', 'DESC')->paginate(7);
        if (count($truyenhoanthanh) > 0) {
            $count_truyenhoanthanh = count($truyenhoanthanh);
            for ($i = 0; $i <= $count_truyenhoanthanh - 1; $i++) {
                $truyenhoanthanh_chapter[$i] = Chapter::where('truyen_id', $truyenhoanthanh[$i]->id)->get();
            }
        } else {
            $truyenhoanthanh_chapter = 0;
        }
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.profile.profile')
            ->with(compact(
                'account',
                'truyendangra',
                'truyenhoanthanh',
                'mail_notify',
                'count_book',
                'truyendangra_chapter',
                'truyenhoanthanh_chapter',
                'total_chap'
            ));
    }
    public function update_profile(Request $request)
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');
        $data = $request->validate(
            [
                'mota' => 'max:255',
            ],
            [
                'mota.max' => 'Giới thiệu truyện tối đa 255 kí tự',
            ]
        );
        $account = Account::find($cus_id);

        if (preg_match_all('~[\p{L}\'\-\xC2\xAD]+~u', $request->tenhienthi) <= 3) {
            $account->username = $request->tenhienthi;
        } else {
            return redirect()->back()->with('error', 'Tên không được dài quá 3 chữ!');
        }
        $account->yearofbirth = $request->namsinh;
        $account->numberphone = $request->sodienthoai;
        $account->sex = $request->gioitinh;
        $account->introduce = $data['mota'];

        $img_name = $request->hinhanh;
        if ($img_name) {
            $path = 'public/uploads/cus_avt/' . $account->avatar;
            if ($account->avatar != '') {
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $file_ext = $img_name->getClientOriginalExtension();
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $input = $request->all();
            if (in_array($file_ext, $permited) === false) {
                return redirect()->back()->with('error', 'Chỉ nhận các tệp: jpg, png, jpeg, gif. Hãy thử lại!');
            } else {
                if ($input['base64image'] || $input['base64image'] != '0') {

                    $folderPath = public_path('uploads/cus_avt/');
                    $image_parts = explode(";base64,", $input['base64image']);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = $folderPath . 'BOOK_IMG_' . date('mdYhisa') . '.wepb';
                    $filename = 'BOOK_IMG_' . date('mdYhisa') . '.wepb';

                    file_put_contents($file, $image_base64);
                    $account->avatar = $filename;
                  
                }
            }
        }
        $account->save();
        Session::put('cus_name', $account->username);
        Session::put('cus_avatar', $account->avatar);
        return redirect()->back()->with('msg', 'Bạn đã cập nhật thành công!');
    }
    public function changePass(Request $request)
    {
        $cus_id = Session::get('cus_id');
        $account = Account::find($cus_id);

        $currentPass = md5($request->currentPass);
        $newPass = md5($request->newPass);
        $repeatNewPass = md5($request->repeatNewPass);
        if ($currentPass === $account->password) {
            if (strlen($request->newPass) >= 8) {
                if ($newPass === $repeatNewPass) {
                    $account->password = $newPass;
                    $account->save();
                    return redirect()->back()->with('msg', 'Bạn đã cập nhật thành công!');
                } else {
                    return redirect()->back()->with('error', 'Mật khẩu mới không trùng khớp!');
                }
            } else {
                return redirect()->back()->with('error', 'Mật khẩu mới phải có độ dài ít nhất là 8 kí tự!');
            }
        } else {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không đúng!');
        }
    }
    public function rewarded()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.rewarded.rewarded')->with(compact('mail_notify'));
    }
    public function notification()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.notification.notification')->with(compact('mail_notify'));
    }
    public function setting()
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');
        $account = Account::find($cus_id);
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.setting.setting')->with(compact('account', 'mail_notify'));
    }
    public function faqs()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        $faq = Faq::where('trangthai', 0)->orderBy('id', 'ASC')->get();
        return view('account.faqs.faqs')->with(compact('faq', 'mail_notify'));
    }
    public function staff_guide()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        $staff = StaffGuide::where('trangthai', 0)->orderBy('id', 'ASC')->get();
        return view('account.staff_guide.staff-guide')->with(compact('staff', 'mail_notify'));
    }
    public function author_guide()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $author = AuthorGuide::where('trangthai', 0)->orderBy('id', 'ASC')->get();
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.author_guide.author-guide')->with(compact('author', 'mail_notify'));
    }
    public function pay()
    {
        $this->check_login();
        $current_page = URL::current();
        Session::put('current_page', $current_page);
        $cus_id = Session::get('cus_id');

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.pay.pay')->with(compact('mail_notify'));
    }
    public function mail()
    {
        $cus_id = Session::get('cus_id');
        $mail = Mail::where('receive_id', $cus_id)->orderBy('trangthai', 'ASC')->orderBy('ngaygui', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.mail.index')->with(compact('mail', 'mail_notify'));
    }
    public function create_mail($id)
    {
        $id = $id;
        $cus_id = Session::get('cus_id');
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.mail.send_mail')->with(compact('id', 'mail_notify'));
    }
    public function read_mail($mail_id)
    {
        $mail = Mail::find($mail_id);
        $cus_id = Session::get('cus_id');

        if ($mail->trangthai != 1) {
            $mail->trangthai = 1;
            $mail->save();
        }
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        return view('account.mail.read_mail')->with(compact('mail', 'mail_notify'));
    }
    public function send_mail(Request $request, $id)
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
        $mail->receive_id = $id;
        $mail->noidung = $data['noidung'];
        $mail->trangthai = '0';
        $mail->save();
        return redirect()->back()->with('msg', 'Bạn đã gửi thành công!');
    }
    public function regulation()
    {
        $cus_id = Session::get('cus_id');
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.pages.regulation')->with(compact('mail_notify'));
    }
}
