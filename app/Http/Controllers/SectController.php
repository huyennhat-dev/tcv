<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\Sect;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SectController extends Controller
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
        $sect = Sect::orderBy('tenluuphai', 'ASC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.sect.index')->with(compact('sect', 'mail_notify', 'approval_notify'));
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
        return view('admin.sect.create')->with(compact('mail_notify', 'approval_notify'));
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
                'tenluuphai' => 'required|unique:tbl_sect|max:255',
                'slug' => 'required|unique:tbl_sect|max:255',
            ],
            [
                'tenluuphai.required' => 'Tên lưu phái không được để trống!',
                'tenluuphai.unique' => 'Tên lưu phái đã tồn tại, hãi thử lại tên khác!',
                'slug.required' => 'Slug không được để trống!',
                'slug.unique' => 'Slug đã tồn tại, hãi thử lại tên khác!',
            ]
        );
        $sect = new Sect();
        $sect->tenluuphai = $data['tenluuphai'];
        $sect->slug = $data['slug'];
        $sect->trangthai = '0';

        $sect->save();
        return redirect()->back()->with('msg', 'Bạn đã thêm thành công!');
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
        $sect = Sect::find($id);
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.sect.edit')->with(compact('sect', 'mail_notify', 'approval_notify'));
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
        $sect = Sect::find($id);
        $sect->trangthai = $request->trangthai;

        $sect->save();
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
        $sect = Sect::find($id);
        $sect->delete();
        return redirect()->back()->with('msg', 'Xóa thành công!');
    }
}
