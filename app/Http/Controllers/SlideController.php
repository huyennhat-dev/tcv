<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\SlideModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SlideController extends Controller
{
    public function check_login()
    {
        $admin_id = Session::get('admin_id');
        if (!isset($admin_id)) {
            return Redirect::to('/admin/login')->send();
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
        $slide = SlideModel::orderBy('id', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.slide.index')->with(compact('slide', 'mail_notify', 'approval_notify'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->check_login();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.slide.create')->with(compact('mail_notify', 'approval_notify'));
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
        $data = $request->validate(
            [
                'hinhanh' => 'required|max:5196',
                'mota' => 'required|max:255'
            ],
            [
                'hinhanh.max' => 'Kích thước tối đa cho slide 5Mb',
                'hinhanh.required' => 'Hình ảnh không được để trống!',
                'mota.required' => 'Mô tả không được để trống!',
            ]
        );
        $slide = new SlideModel();
        $slide->mota = $data['mota'];
        $slide->trangthai = '0';

        $img_name = $request->hinhanh;
        $file_ext = $img_name->getClientOriginalExtension();
        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $input = $request->all();
        if (in_array($file_ext, $permited) === false) {
            return redirect()->back()->with('error', 'Chỉ nhận các tệp: jpg, png, jpeg, gif. Hãy thử lại!');
        } else {
            if ($input['base64image'] || $input['base64image'] != '0') {

                $folderPath = public_path('uploads/slide/');
                $image_parts = explode(";base64,", $input['base64image']);
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                $file = $folderPath . 'Slide_IMG_' . date('mdYhisa') . '.wepb';
                $filename = 'Slide_IMG_' . date('mdYhisa') . '.wepb';

                file_put_contents($file, $image_base64);

                $slide->hinhanh = $filename;
            }
            $slide->save();
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
        $slide = SlideModel::find($id);
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.slide.edit')->with(compact('slide', 'mail_notify', 'approval_notify'));
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
                'hinhanh' => 'max:5196',
                'mota' => 'required|max:255'
            ],
            [
                'hinhanh.max' => 'Kích thước tối đa cho slide 5Mb',
                'mota.required' => 'Mô tả không được để trống!',
            ]
        );
        $slide =  SlideModel::find($id);
        $slide->mota = $data['mota'];
        $slide->trangthai = $request->trangthai;
        $img_name = $request->hinhanh;

        if ($img_name) {
            $path = 'public/uploads/slide/' . $slide->hinhanh;
            if (file_exists($path)) {
                unlink($path);
            }
            $file_ext = $img_name->getClientOriginalExtension();
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $input = $request->all();

            if (in_array($file_ext, $permited) === false) {
                return redirect()->back()->with('error', 'Chỉ nhận các tệp: jpg, png, jpeg, gif. Hãy thử lại!');
                die();
            } else {
                if ($input['base64image'] || $input['base64image'] != '0') {

                    $folderPath = public_path('uploads/slide/');
                    $image_parts = explode(";base64,", $input['base64image']);
                    $image_type_aux = explode("image/", $image_parts[0]);
                    $image_type = $image_type_aux[1];
                    $image_base64 = base64_decode($image_parts[1]);
                    $file = $folderPath . 'Slide_IMG_' . date('mdYhisa') . '.jpg';
                    $filename = 'Slide_IMG_' . date('mdYhisa') . '.jpg';

                    file_put_contents($file, $image_base64);

                    $slide->hinhanh = $filename;
                }
            }
        }
        $slide->save();
        return redirect()->back()->with('msg', 'Bạn đã sửa thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->check_login();
        $slide = SlideModel::find($id);
        $path = 'public/uploads/slide/' . $slide->hinhanh;
        if (file_exists($path)) {
            unlink($path);
        }
        $slide->delete();
        return redirect()->back()->with('msg', 'Xóa thành công!');
    }
}
