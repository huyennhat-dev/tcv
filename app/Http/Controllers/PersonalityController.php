<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\Personality;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PersonalityController extends Controller
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
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        $personality = Personality::orderBy('tentinhcach', 'ASC')->get();
        return view('admin.personality.index')->with(compact('personality', 'mail_notify', 'approval_notify'));
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
        return view('admin.personality.create')->with(compact('mail_notify', 'approval_notify'));
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
                'tentinhcach' => 'required|unique:tbl_personality|max:255',
                'slug' => 'required|unique:tbl_personality|max:255',
            ],
            [
                'tentinhcach.required' => 'Tên tính cách nhân vật không được để trống!',
                'tentinhcach.unique' => 'Tên tính cách nhân vật đã tồn tại, hãi thử lại tên khác!',
                'slug.required' => 'Slug không được để trống!',
                'slug.unique' => 'Slug đã tồn tại, hãi thử lại tên khác!',
            ]
        );
        $personality = new Personality();
        $personality->tentinhcach = $data['tentinhcach'];
        $personality->slug = $data['slug'];
        $personality->trangthai = '0';

        $personality->save();
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
        $personality = Personality::find($id);
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.personality.edit')->with(compact('personality', 'mail_notify', 'approval_notify'));
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
        $personality = Personality::find($id);
        $personality->trangthai = $request->trangthai;

        $personality->save();
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
        $personality = Personality::find($id);
        $personality->delete();
        return redirect()->back()->with('msg', 'Xóa thành công!');
    }
}
