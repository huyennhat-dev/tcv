<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
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
        $category = Category::orderBy('id', 'DESC')->get();
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.category.index')->with(compact('category', 'mail_notify', 'approval_notify'));
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
        return view('admin.category.create')->with(compact('mail_notify', 'approval_notify'));
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
                'tentheloai' => 'required|unique:tbl_category|max:255',
                'slug' => 'required|unique:tbl_category|max:255',
                'mota' => 'required|max:255',
            ],
            [
                'tentheloai.required' => 'Tên thể loại không được để trống!',
                'tentheloai.unique' => 'Tên thể loại đã tồn tại, hãi thử lại tên khác!',
                'slug.required' => 'Slug không được để trống!',
                'slug.unique' => 'Slug đã tồn tại, hãi thử lại tên khác!',
                'mota.required' => 'Mô tả không được để trống!',
                'mota.max' => 'Mô tả tối đa 255 kí tự!',
            ]
        );
        $category = new Category();
        $category->mota = $data['mota'];
        $category->tentheloai = $data['tentheloai'];
        $category->slug = $data['slug'];
        $category->trangthai = '0';

        $category->save();
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
        $category = Category::find($id);
        $mail_notify  = Mail::where('receive_id', 0)->where('trangthai', 0)->get();
        $approval_notify = Book::where('trangthai', 0)->get();
        return view('admin.category.edit')->with(compact('category', 'mail_notify', 'approval_notify'));
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
                'mota' => 'required|max:255',
            ],
            [
                'mota.required' => 'Mô tả không được để trống!',
            ]
        );
        $category = Category::find($id);
        $category->mota = $data['mota'];
        $category->trangthai = $request->trangthai;

        $category->save();
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
        $category = Category::find($id);
        $book = Book::where('theloai_id', $id)->get();
        if(count($book)>0){
            for($i=0; $i<= count($book) - 1; $i++){
                $book[$i]->delete();
            }
        }
        $category->delete();
        return redirect()->back()->with('msg', 'Xóa thành công!');
    }
}
