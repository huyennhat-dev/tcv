<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Account;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\World;
use App\Models\Sect;
use App\Models\Personality;
use App\Models\Mail;

use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function check_login()
    {
        $cus_id = Session::get('cus_id');
        if (!isset($cus_id)) {
            return redirect()->to('/account/login')->send();
            die();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->check_login();

        $cus_id = Session::get('cus_id');
        $truyen = Book::where('nguoidang_id', $cus_id)->orderBy('id', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $truyenid[$i] = $truyen[$i]->id;
                $chuongmoi[$i] = Chapter::where('truyen_id', $truyenid[$i])->orderBy('id', 'DESC')->first();
            }
        } else {
            $chuongmoi = '';
        }

        return view('account.books.listBook')->with(compact('chuongmoi', 'truyen', 'mail_notify'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.books.addBook')->with(compact('theloai', 'thegioi', 'tinhcach', 'luuphai', 'mail_notify'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->check_login();
        $cus_id = Session::get('cus_id');

        $data = $request->validate(
            [
                'hinhanh' => 'required|max:2048',
                'tentruyen' => 'required|unique:tbl_book|max:255',
                'slug' => 'required|unique:tbl_book|max:255',
                'tacgia' => 'required|max:255',
                'mota' => 'required|max:8000',
            ],
            [
                'hinhanh.max' => 'Kích thước cho phép tối đa là 2Mb',
                'hinhanh.required' => 'Ảnh bìa truyện không được để trống',
                'tentruyen.required' => 'Tên truyện không được để trống',
                'tentruyen.required' => 'Tên truyện tối đa',
                'tacgia.required' => 'Tên tác giả không được để trống',
                'tacgia.max' => 'Tên tác giả tối đa 255 kí tự',
                'mota.required' => 'Giới thiệu truyện không được để trống',
                'mota.max' => 'Giới thiệu truyện tối đa 8000 kí tự',
                'slug.required' => 'slug không được để trống',
            ]
        );
        $truyen = new Book();
        $truyen->tentruyen = trim(ucwords($data['tentruyen']));
        $truyen->slug = $data['slug'];
        $truyen->tacgia = trim(ucwords($data['tacgia']));
        $truyen->mota = $data['mota'];

        $truyen->trangthai = '0';
        $truyen->tinhtrang = '0';

        $truyen->phanloai = $request->phanloai;
        $truyen->theloai_id = $request->theloai;

        $truyen->tinhcach_id = $request->tinhcach;
        $truyen->thegioi_id = $request->thegioi;
        $truyen->luuphai_id = $request->luuphai;

        $truyen->nguoidang_id = $request->nguoidang_id;

        $truyen->luotxem = '0';
        $truyen->luotdecu = '0';
        $truyen->sobinhluan = '0';
        $truyen->sochuong = '0';

        $img_name = $request->hinhanh;
        $file_ext = $img_name->getClientOriginalExtension();
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $input = $request->all();
        if (in_array($file_ext, $permited) === false) {
            return redirect()->back()->with('error', 'Chỉ nhận các tệp: jpg, png, jpeg, gif. Hãy thử lại!');
        } else {
            if ($input['base64image'] || $input['base64image'] != '0') {

                $folderPath = public_path('uploads/truyen/');
                $image_parts = explode(";base64,", $input['base64image']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $file = $folderPath . 'BOOK_IMG_' . date('mdYhisa') . '.wepb';
                $filename = 'BOOK_IMG_' . date('mdYhisa') . '.wepb';

                file_put_contents($file, $image_base64);

                $truyen->hinhanh = $filename;
            }
            $truyen->save();
            return redirect()->back()->with('msg', 'Bạn đã thêm thành công!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->check_login();
        $truyen = Book::find($id);
        $cus_id = Session::get('cus_id');

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $mail_notify  = Mail::where('receive_id', $cus_id)->where('trangthai', 0)->get();

        return view('account.books.editBook')->with(compact('truyen', 'theloai', 'thegioi', 'tinhcach', 'luuphai', 'mail_notify'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->check_login();

        $data = $request->validate(
            [
                'hinhanh' => 'max:2048',
                'mota' => 'required|max:8000',
            ],
            [
                'hinhanh.max' => 'Kích thước cho phép tối đa là 2Mb',
                'mota.required' => 'Giới thiệu truyện không được để trống',
                'mota.max' => 'Giới thiệu truyện tối đa 8000 kí tự',
            ]
        );
        $truyen = Book::find($id);
        $truyen->mota = $data['mota'];

        $truyen->tinhtrang = $request->tinhtrang;

        $truyen->theloai_id = $request->theloai;

        $truyen->tinhcach_id = $request->tinhcach;
        $truyen->thegioi_id = $request->thegioi;
        $truyen->luuphai_id = $request->luuphai;
        $truyen->sochuong = 0;

        $img_name = $request->hinhanh;
        if ($img_name) {
            $path = 'public/uploads/slide/' . $truyen->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $file_ext = $img_name->getClientOriginalExtension();
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $input = $request->all();
            if (in_array($file_ext, $permited) === false) {
                return redirect()->back()->with('error', 'Chỉ nhận các tệp: jpg, png, jpeg, gif. Hãy thử lại!');
            } else {
                if ($input['base64image'] || $input['base64image'] != '0') {

                    $folderPath = public_path('uploads/truyen/');
                    $image_parts = explode(";base64,", $input['base64image']);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = $folderPath . 'BOOK_IMG_' . date('mdYhisa') . '.wepb';
                    $filename = 'BOOK_IMG_' . date('mdYhisa') . '.wepb';

                    file_put_contents($file, $image_base64);
                    $truyen->hinhanh = $filename;
                }
            }
        }
        $truyen->save();
        return redirect()->back()->with('msg', 'Bạn đã cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
