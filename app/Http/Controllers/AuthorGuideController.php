<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AuthorGuide;
use App\Models\Book;
use App\Models\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthorGuideController extends Controller
{
    // public function check_login()
    // {
    //     $admin_id = Session::get('admin_id');
    //     if (!isset($admin_id)) {
    //         return Redirect::to('/admin/login')->send();
    //         die();
    //     }
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->check_login();
        $authorGuide = AuthorGuide::orderBy('id', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.author_guide.index')->with(compact('authorGuide', 'mail_notify', 'approval_notify'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->check_login();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.author_guide.create')->with(compact('mail_notify', 'approval_notify'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->check_login();
        $data = $request->validate(
            [
                'cauhoi' => 'required|unique:tbl_authorguide|max:1000',
                'cautraloi' => 'required|unique:tbl_authorguide|max:10000',
            ],
            [
                'cauhoi.required' => 'Câu hỏi không được để trống!',
                'cauhoi.unique' => 'Câu hỏi đã tồn tại, hãi thử lại tên khác!',
                'cauhoi.max' => 'Câu hỏi tối đa 1000 kí tự!',
                'cautraloi.required' => 'Câu trả lời không được để trống!',
                'cautraloi.unique' => 'Câu trả lời đã tồn tại, hãi thử lại tên khác!',
                'cautraloi.max' => 'Câu trả lời tối đa 10000 kí tự!',
            ]
        );
        $authorGuide = new AuthorGuide();
        $authorGuide->cauhoi = $data['cauhoi'];
        $authorGuide->cautraloi = $data['cautraloi'];
        $authorGuide->trangthai = '0';

        $authorGuide->save();
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
        // $this->check_login();
        $authorGuide = AuthorGuide::find($id);
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.author_guide.edit')->with(compact('authorGuide', 'mail_notify', 'approval_notify'));
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
        // $this->check_login();
        $authorGuide = AuthorGuide::find($id);
        $authorGuide->trangthai = $request->trangthai;

        $authorGuide->save();
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
        // $this->check_login();
        $authorGuide = AuthorGuide::find($id);
        $authorGuide->delete();
        return redirect()->back()->with('msg', 'Xóa thành công!');
    }
}
