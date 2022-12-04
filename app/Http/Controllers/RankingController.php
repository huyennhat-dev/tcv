<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SlideModel;
use App\Models\World;
use App\Models\Sect;
use App\Models\Personality;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Rating;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class RankingController extends Controller
{
    public function docnhieu()
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::orderBy('id', 'DESC')->get();
        $slide = SlideModel::all()->random();
        $tinhcach = Personality::get();
        $luuphai = Sect::get();
        $thegioi = World::get();

        $truyen = Book::where('trangthai', 1)->orderBy('luotxem', 'DESC')->paginate(20);
        if(count($truyen)>0){
            for($i=0; $i <= count($truyen)-1; $i++){
            $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
            $count_chap_x[$i] = count($count_chapter_x[$i]);
            $count_vote[$i] = Rating::where('truyen_id', $truyen[$i]->id)->get();
            $total_vote[$i] = count($count_vote[$i]);
            }
        }else{
            $count_chap_x = 0; 
            $total_vote= 0;
        }
        /*********************SEO********************* */
        $title = 'Bảng Xếp Hạng Truyện Convert - Đọc Nhiều';
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.rank.readalot')
            ->with(compact(
                'slide',
                'theloai',
                'tinhcach',
                'luuphai',
                'thegioi',
                'truyen',
                'count_chap_x',
                'total_vote',
                'meta_desc',
                'meta_keywords',
                'og_image',
                'title',
                'meta_tag'

            ));
    }
    public function decu()
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::orderBy('id', 'DESC')->get();
        $slide = SlideModel::all()->random();
        $tinhcach = Personality::get();
        $luuphai = Sect::get();
        $thegioi = World::get();
        $truyen = Book::where('trangthai', 1)->orderBy('luotdecu', 'DESC')->paginate(20);
        if(count($truyen)>0){
            for($i=0; $i <= count($truyen)-1; $i++){
            $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
            $count_chap_x[$i] = count($count_chapter_x[$i]);
            $count_vote[$i] = Rating::where('truyen_id', $truyen[$i]->id)->get();
            $total_vote[$i] = count($count_vote[$i]);
            }
        }else{
            $count_chap_x = 0;
            $total_vote= 0;
        }
        /*********************SEO********************* */
        $title = 'Bảng Xếp Hạng Truyện Convert - Đề Cử';
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */

        return view('home.rank.nomination')
            ->with(compact(
                'slide',
                'theloai',
                'tinhcach',
                'luuphai',
                'thegioi',
                'truyen',
                'count_chap_x',
                'total_vote',
                'meta_desc',
                'meta_keywords',
                'og_image',
                'title',
                'meta_tag'
            ));
    }
    public function danhgia()
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::orderBy('id', 'DESC')->get();
        $slide = SlideModel::all()->random();
        $tinhcach = Personality::get();
        $luuphai = Sect::get();
        $thegioi = World::get();

        $truyen = Book::where('trangthai', 1)->where('sodanhgia', '>=', 1)->orderBy('sosao', 'DESC')->paginate(20);
         if(count($truyen)>0){
            for($i=0; $i <= count($truyen)-1; $i++){
            $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
            $count_chap_x[$i] = count($count_chapter_x[$i]);
            $count_vote[$i] = Rating::where('truyen_id', $truyen[$i]->id)->get();
            $total_vote[$i] = count($count_vote[$i]);
            }
        }else{
            $count_chap_x = 0;
             $total_vote= 0;
        }
        /*********************SEO********************* */
        $title = 'Bảng Xếp Hạng Truyện Convert - Đánh Giá';
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */

        return view('home.rank.evaluate')
            ->with(compact(
                'slide',
                'theloai',
                'tinhcach',
                'luuphai',
                'thegioi',
                'truyen',
                'count_chap_x',
                'total_vote',
                'meta_desc',
                'meta_keywords',
                'og_image',
                'title',
                'meta_tag'
            ));
    }
    public function thaoluan()
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::orderBy('id', 'DESC')->get();
        $slide = SlideModel::all()->random();
        $tinhcach = Personality::get();
        $luuphai = Sect::get();
        $thegioi = World::get();
        $truyen = Book::where('trangthai', 1)->orderBy('sobinhluan', 'DESC')->paginate(20);
           if(count($truyen)>0){
            for($i=0; $i <= count($truyen)-1; $i++){
            $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
            $count_chap_x[$i] = count($count_chapter_x[$i]);
            $count_vote[$i] = Rating::where('truyen_id', $truyen[$i]->id)->get();
            $total_vote[$i] = count($count_vote[$i]);
            }
        }else{
            $count_chap_x = 0;
            $total_vote= 0;
        }
        /*********************SEO********************* */
        $title = 'Bảng Xếp Hạng Truyện Convert - Thảo Luận';
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */

        return view('home.rank.discuss')
            ->with(compact(
                'slide',
                'theloai',
                'tinhcach',
                'luuphai',
                'thegioi',
                'count_chap_x',
                'total_vote',
                'truyen',
                'meta_desc',
                'meta_keywords',
                'og_image',
                'title',
                'meta_tag'
            ));
    }
}
