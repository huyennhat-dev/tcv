<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Account;
use App\Models\Category;
use App\Models\SlideModel;
use App\Models\World;
use App\Models\Sect;
use App\Models\Personality;
use App\Models\ChapterComment;
use App\Models\BookComment;
use App\Models\Rating;
use App\Models\TickBook;
use App\Models\ReadingBooks;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Query\Builder;

class HomeController extends Controller
{
    public function check_login()
    {
        $cus_id = Session::get('cus_id');
        if (!isset($cus_id)) {
            return redirect()->to('/account/login')->send();
            die();
        }
    }
    public function index()
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $cus_id = Session::get('cus_id');

        $theloai = Category::where('trangthai', 0)->orderBy('id', 'DESC')->get();
        $theloai = Category::where('trangthai', 0)->orderBy('id', 'DESC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::get();
        $luuphai = Sect::get();
        $thegioi = World::get();

        $top_1_luotxem = Book::where('trangthai', 1)->orderBy('luotxem', 'DESC')->first();
        $top10_luotxem = Book::where('trangthai', 1)->orderBy('luotxem', 'DESC')->skip(1)->take(9)->get();

        $top1_binhluan = Book::where('trangthai', 1)->orderBy('sobinhluan', 'DESC')->first();
        $top10_binhluan = Book::where('trangthai', 1)->orderBy('sobinhluan', 'DESC')->skip(1)->take(9)->get();

        $top1_decu = Book::where('trangthai', 1)->orderBy('luotdecu', 'DESC')->first();
        $top10_decu = Book::where('trangthai', 1)->where('tinhtrang', '0')->orderBy('luotdecu', 'DESC')->skip(1)->take(9)->get();

        $chap_moi = Chapter::with('truyen')
            ->select('*')
            ->where('trangthai', 1)
            ->orderBy('ngaydang', 'DESC')
            ->get()->unique('truyen_id')->take(15);
        $truyenhoanthanh = Book::where('trangthai', 1)->where('tinhtrang', '1')->get()->take(15);
        for ($i = 0; $i <= count($truyenhoanthanh) - 1; $i++) {
            $count_chapter_x[$i] = Chapter::where('truyen_id', $truyenhoanthanh[$i]->id)->get();
            $count_chap_x[$i] = count($count_chapter_x[$i]);
        }
        $rand_btvdecu = Book::where('trangthai', 1)->inRandomOrder()->limit(8)->get();

        $dangdoc_2 = Book::all()->where('trangthai', 1)->random(8);

        $vote = Rating::select('*')->where('trangthai', 1)->orderBy('id', 'DESC')->get()->unique('truyen_id')->take(4);

        $topdanhgia = Book::with('rating')->select('*')
            ->where('trangthai', 1)
            ->where('sodanhgia', '>=', '1')
            ->orderBy('sosao', 'DESC')
            ->take(8)->get();

        for ($i = 0; $i <= 7; $i++) {
            $count_chapter[$i] = Chapter::where('truyen_id', $rand_btvdecu[$i]->id)->get();
            $count_chap[$i] = count($count_chapter[$i]);
            $count_chapter_y[$i] = Chapter::where('truyen_id', $dangdoc_2[$i]->id)->get();
            $count_chap_y[$i] = count($count_chapter_y[$i]);
        }
        /*********************SEO********************* */
        $title = 'Truyện Convert - Đọc Truyện Online Miễn Phí | Truyện CV - TruyenCV';
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen cv, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.wepb');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.home.index')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'chap_moi',
            'truyenhoanthanh',
            'top_1_luotxem',
            'top10_luotxem',
            'top1_binhluan',
            'top10_binhluan',
            'top1_decu',
            'top10_decu',
            'rand_btvdecu',
            'dangdoc_2',
            'count_chap',
            'count_chap_x',
            'count_chap_y',
            'vote',
            'topdanhgia',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }

    public function load_reading(Request $request)
    {
        $cus_id = Session::get('cus_id');
        $dangdoc = ReadingBooks::where('u_id', $cus_id)->orderBy('id', 'DESC')->take(8)->get();


        $output = '';
        if ($cus_id) {
            if ($dangdoc) {
                foreach ($dangdoc as $key => $val) {

                    $chapter = Chapter::where('truyen_id', $val->truyen_id)->get();

                    $output .= '<li class="media align-items-center py-2 mb-1 pl-2 pr-2">';
                    $output .= '<a href="' . url('truyen/') . '/' . $val->truyen->slug . '" class="nh-thumb nh-thumb--32 shadow mr-3" style="width: 40px;">';
                    $output .= '<img alt="' . $val->truyen->tentruyen . '" title="' . $val->truyen->tentruyen . '" width="40 " src="' . url('public/uploads/truyen/') . '/' . $val->truyen->hinhanh . '">';
                    $output .= '</a>';
                    $output .= '<div class="media-body">';
                    $output .= '<h2 class="fz-body mb-1">';
                    $output .= '<a href="' . url('truyen/') . '/' . $val->truyen->slug . '" class="text-overflow-1-lines">' . $val->truyen->tentruyen . '</a>';
                    $output .= '</h2>';
                    $output .= '<div class="d-flex text-muted text-overflow-1-lines text-secondary fz-12">';
                    $output .= '<div class="already_read" style="width: 20%;">Đã đọc:</div>';
                    $output .= '<div class="ml-2 d-flex w-100">';
                    $output .= '<a class=" text-secondary fz-12 text-overflow-1-lines" >';
                    $output .= '<small class="text-overflow-1-lines">' . $val->chuong->slug . '/' . count($chapter) . ' </small>';
                    $output .= '</a>';
                    $output .= '<a class="text-secondary fz-12 ml-2 del_reading_btn"  id="" data-idx="' . $val->id . '" >';
                    $output .= '<small class="text-muted ml-1"><i class="nh-icon ti-trash"></i></small>';
                    $output .= '</a>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '</div>';
                    $output .= '<a href="' . url('truyen/') . '/' . $val->truyen->slug . '/chuong-' . $val->chuong->slug . '" class="float-left fz-12">';
                    $output .= '<small class="text-primary">Đọc tiếp</small>';
                    $output .= '</a>';
                    $output .= '</li>';
                }
            }
        }
        echo $output;
    }

    public function del_reading(Request $request)
    {
        $id = $request->id;
        $truyen = ReadingBooks::find($id);
        $truyen->delete();
    }

    public function theloai($slug)
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $theloai_id = Category::where('slug', $slug)->first();
        $truyen = Book::where('trangthai', 1)->where('theloai_id', $theloai_id->id)->orderBy('id', 'DESC')->paginate(20);
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
                $count_chap_x[$i] = count($count_chapter_x[$i]);
            }
        } else {
            $count_chap_x = 0;
        }
        /*********************SEO********************* */
        $title = 'Truyện Convert - ' . $theloai_id->tentheloai;
        $meta_desc = 'Truyện Convert - ' . $theloai_id->mota;
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.category.category')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'theloai_id',
            'count_chap_x',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function tinhcach($slug)
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $tinhcach_id = Personality::where('slug', $slug)->first();
        $truyen = Book::where('trangthai', 1)->where('tinhcach_id', $tinhcach_id->id)->paginate(20);
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
                $count_chap_x[$i] = count($count_chapter_x[$i]);
            }
        } else {
            $count_chap_x = 0;
        }
        /*********************SEO********************* */
        $title = 'Truyện Convert - ' . $tinhcach_id->tentinhcach;
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.personality.personality')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'tinhcach_id',
            'count_chap_x',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function thegioi($slug)
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $thegioi_id = World::where('slug', $slug)->first();
        $truyen = Book::where('trangthai', 1)->where('thegioi_id', $thegioi_id->id)->paginate(20);
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
                $count_chap_x[$i] = count($count_chapter_x[$i]);
            }
        } else {
            $count_chap_x = 0;
        }
        /*********************SEO********************* */
        $title = 'Truyện Convert - ' . $thegioi_id->tenthegioi;
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.world.world')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'thegioi_id',
            'count_chap_x',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function luuphai($slug)
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $luuphai_id = Sect::where('slug', $slug)->first();
        $truyen = Book::where('trangthai', 1)->where('luuphai_id', $luuphai_id->id)->paginate(20);
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
                $count_chap_x[$i] = count($count_chapter_x[$i]);
            }
        } else {
            $count_chap_x = 0;
        }
        /*********************SEO********************* */
        $title = 'Truyện Convert - ' . $luuphai_id->tenluuphai;
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.sect.sect')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'luuphai_id',
            'count_chap_x',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function trangthai($id)
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $trangthai = $id;
        $truyen = Book::where('trangthai', 1)->where('tinhtrang', $trangthai)->paginate(20);
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
                $count_chap_x[$i] = count($count_chapter_x[$i]);
            }
        } else {
            $count_chap_x = 0;
        }
        /*********************SEO********************* */
        if ($trangthai === 0) {
            $title = 'Truyện Convert - Đang Ra';
        } else {
            $title = 'Truyện Convert - Hoàn Thành';
        }
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.status.status')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'trangthai',
            'count_chap_x',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function thigiac($id)
    {
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $thigiac = $id;
        $truyen = Book::where('trangthai', 1)->where('phanloai', $thigiac)->paginate(20);
        if (count($truyen) > 0) {
            for ($i = 0; $i <= count($truyen) - 1; $i++) {
                $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
                $count_chap_x[$i] = count($count_chapter_x[$i]);
            }
        } else {
            $count_chap_x = 0;
        }
        /*********************SEO********************* */
        if ($thigiac === 0) {
            $title = 'Truyện Convert - Truyện Nam';
        } else {
            $title = 'Truyện Convert - Truyện Nữ';
        }
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.view.view')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'thigiac',
            'count_chap_x',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }

    public function xemtruyen($slug)
    {
        $cus_id = Session::get('cus_id');
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $truyen = Book::where('slug', $slug)->where('trangthai', '1')->first();
        $nguoidang_id = $truyen->nguoidang_id;
        $truyencungnguoidang = Book::where('trangthai', '1')
            ->where('nguoidang_id', $nguoidang_id)
            ->orderBy('id', 'DESC')->get();
        $truyencungtacgia = Book::where('trangthai', '1')->where('tacgia', $truyen->tacgia)->take(10)->get();
        $rand5slide = SlideModel::all()->random(5);

        $chuongmoi = Chapter::where('truyen_id', $truyen->id)->orderBy('id', 'DESC')->first();
        $chuongdau = Chapter::where('truyen_id', $truyen->id)->orderBy('id', 'ASC')->first();
        $toanbochuong =  Chapter::where('truyen_id', $truyen->id)->orderBy('id', 'ASC')->get();

        $tickbook = TickBook::where('truyen_id', $truyen->id)->get();
        $socatgiu = count($tickbook);
        if ($truyen) {
            $book = Book::where('nguoidang_id', $nguoidang_id)->get();
            $count_book = count($book);
            for ($i = 0; $i <= $count_book - 1; $i++) {
                $chapter[$i] = Chapter::where('truyen_id', $book[$i]->id)->get();
                $count_chap_x[$i] = count($chapter[$i]);
            }
            $total_chap =  array_sum($count_chap_x);
            $chapter = Chapter::where('truyen_id', $truyen->id)->get();
            $count_chap = count($chapter);

            $book_cmt = BookComment::where('truyen_id', $truyen->id)->get();
            $chap_cmt = ChapterComment::where('truyen_id', $truyen->id)->get();
            $count_cmt = count($book_cmt);
            $count_vote = Rating::where('truyen_id', $truyen->id)->get();
        }
        $doctiep = ReadingBooks::where('u_id', $cus_id)->where('truyen_id', $truyen->id)->first();
        /*********************SEO********************* */
        $title = $truyen->tentruyen;
        $meta_desc = 'Đọc truyện ' . $truyen->tentruyen . ' do ' . $truyen->tacgia . ' sáng tác, được convert bởi ' . $truyen->nguoidang->username;
        $meta_keywords = 'Truyện Convert, Truyen CV , ' .  $truyen->tentruyen . ', ' . $truyen->nguoidang->username . ', ' . $truyen->tacgia . ', ' . $truyen->theloai->tentheloai;
        $og_image = url('public/uploads/truyen/') . '/' . $truyen->hinhanh;
        $meta_tag = $truyen->tentruyen;
        /*********************END SEO********************* */
        return view('home.detail.detail')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'truyencungnguoidang',
            'truyencungtacgia',
            'chuongmoi',
            'chuongdau',
            'doctiep',
            'toanbochuong',
            'rand5slide',
            'socatgiu',
            'count_cmt',
            'count_chap',
            'count_vote',
            'total_chap',
            'count_book',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function xemchuong($slug_truyen, $slug_chuong)
    {
        $cus_id = Session::get('cus_id');
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $truyen = Book::where('slug', $slug_truyen)->first();
        $chuong = Chapter::where('trangthai', 1)->where('truyen_id', $truyen->id)->where('slug', $slug_chuong)->first();
        $toanbochuong =  Chapter::where('trangthai', 1)->where('truyen_id', $truyen->id)->orderBy('id', 'ASC')->get();

        $next_chapter = Chapter::where('trangthai', 1)->where('truyen_id', $chuong->truyen_id)->where('id', '>', $chuong->id)->min('slug');
        $prev_chapter = Chapter::where('trangthai', 1)->where('truyen_id', $chuong->truyen_id)->where('id', '<', $chuong->id)->max('slug');

        // dd($next_chapter);
        $max_id = Chapter::where('trangthai', 1)->where('truyen_id', $chuong->truyen_id)->orderBy('id', 'DESC')->first();
        $min_id = Chapter::where('trangthai', 1)->where('truyen_id', $chuong->truyen_id)->orderBy('id', 'ASC')->first();

        $luotxem = Book::findOrFail($truyen->id);
        $luotxem->increment('luotxem');
        $luotxem_chuong = Chapter::findOrFail($chuong->id);
        $luotxem_chuong->increment('luotdoc');
        $count_cmt = ChapterComment::where('truyen_id', $truyen->id)->where('chuong_id', $chuong->id)->get();
        if ($cus_id) {
            $check_readingbook = ReadingBooks::where('u_id', $cus_id)
                ->where('truyen_id', $truyen->id)
                ->get();
            if (count($check_readingbook) < 1) {
                $readingbook = new ReadingBooks();
                $readingbook->truyen_id = $truyen->id;
                $readingbook->chuong_id = $chuong->id;
                $readingbook->chuong_slug = $chuong->slug;
                $readingbook->u_id = $cus_id;
                $readingbook->hinhanh = $truyen->hinhanh;
                $readingbook->tentruyen = $truyen->tentruyen;
                $readingbook->save();
            } else {
                $readingbook = ReadingBooks::where('truyen_id', $truyen->id)->where('u_id', $cus_id)->first();
                $readingbook->chuong_id = $chuong->id;
                $readingbook->chuong_slug = $chuong->slug;
                $readingbook->save();
            }
        }
        /*********************SEO********************* */
        $title = 'Đọc ' . $truyen->tentruyen . ' Chương ' . $chuong->slug;
        $meta_desc = 'Đọc chương ' . $chuong->tenchuong . ' của truyện ' . $truyen->tentruyen . ' thuộc thể loại ' . $truyen->theloai->tentheloai;
        $meta_keywords = $chuong->tenchuong . ', ' . $truyen->tentruyen . ', ' . $truyen->theloai->tentheloai;
        $og_image = url('public/uploads/truyen/') . '/' . $truyen->hinhanh;
        $meta_tag = $truyen->tentruyen . ', ' . $truyen->theloai->tentheloai;
        /*********************END SEO********************* */
        return view('home.chapter.chapter')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'chuong',
            'toanbochuong',
            'count_cmt',
            'next_chapter',
            'prev_chapter',
            'max_id',
            'min_id',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
    public function send_comment(Request $request)
    {
        $cus_id = Session::get('cus_id');
        if (isset($cus_id)) {
            $binhluan = new ChapterComment();
            $truyen = Book::find($request->truyen_id);
            $truyen->sobinhluan += 1;
            $binhluan->u_id = $cus_id;
            $binhluan->chuong_id = $request->chuong_id;
            $binhluan->noidung = $request->cmt_content;
            $binhluan->truyen_id = $request->truyen_id;
            $truyen->save();
            $binhluan->save();
        } else {
            return redirect()->to('/account/login')->send();
            die();
        }
    }
    public function load_comment(Request $request)
    {
        $truyen_id = $request->truyen_id;
        $chuong_id = $request->chuong_id;
        $limit = $request->limit;
        $start = $request->start;

        $binhluan = ChapterComment::where('truyen_id', $truyen_id)
            ->where('chuong_id', $chuong_id)
            ->orderBy('id', 'DESC')
            ->skip($start)
            ->take($limit)->get();

        // dd($binhluan);
        $output = '';
        if (!$binhluan->isEmpty()) {
            foreach ($binhluan as $key => $cmt) {
                $output .= '<li class="chap_cmt_x comment-items media py-3 border-bottom">';
                $output .= '<div class="nh-avatar--45 mr-3 position-relative" style="cursor: pointer;">';
                $output .= '<img alt="" class="br-50 img-fluid size-45" src="' . url('public/uploads/cus_avt/') . '/' . $cmt->user_2->avatar . '">';
                $output .= '</div>';
                $output .= '<div class="media-body">';
                $output .= '<a href="" class="d-inline-block h5 mb-1 fz-14 fw-600">' . $cmt->user_2->username . '</a>';
                $output .= '<div class="d-flex align-items-center">';
                $output .= '<span class="d-flex align-items-center text-tertiary fz-13">';
                $output .= '<i class="nh-icon ti-timer mr-2 "></i>' . $cmt->ngaythem;
                $output .= '</span>';
                $output .= '</div>';
                $output .= '<div class="mt-2 fz-13 fw-400 lh-15x text-black">' . $cmt->noidung . '</div>';
                $output .= '<div class="d-flex mt-3">';
                $output .= '<div class="mr-auto">';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</li>';
            }
        }
        echo $output;
    }
    public function send_book_comment(Request $request)
    {
        $cus_id = Session::get('cus_id');
        if (isset($cus_id)) {
            $binhluan = new BookComment();
            $truyen = Book::find($request->truyen_id);
            $truyen->sobinhluan += 1;
            $binhluan->u_id = $cus_id;
            $binhluan->noidung = $request->comment_content;
            $binhluan->truyen_id = $request->truyen_id;
            $truyen->save();
            $binhluan->save();
        } else {
            return redirect()->to('/account/login')->send();
            die();
        }
    }
    public function load_book_comment(Request $request)
    {
        $truyen_id = $request->truyen_id;

        $limit = $request->limit;
        $start = $request->start;
        $binhluan = BookComment::where('truyen_id', $truyen_id)
            ->orderBy('id', 'DESC')
            ->skip($start)
            ->take($limit)->get();

        // dd($binhluan);
        $output = '';
        if (!$binhluan->isEmpty()) {
            foreach ($binhluan as $key => $cmt) {

                $output .= '<li class="cmt_x comment-items media py-3 border-bottom">';
                $output .= '<div class=" nh-avatar--45 mr-3 position-relative" style="cursor: pointer;">';
                $output .= '<img alt="" class="br-50 img-fluid size-45" src="' . url('public/uploads/cus_avt/') . '/' . $cmt->user->avatar . '">';
                $output .= '</div>';
                $output .= '<div class="media-body">';
                $output .= '<a href="" class="d-inline-block h5 mb-1 fz-14 fw-600">' . $cmt->user->username . '</a>';
                $output .= '<div class="d-flex align-items-center">';
                $output .= '<span class="d-flex align-items-center text-tertiary fz-13">';
                $output .= '<i class="nh-icon ti-timer mr-2 "></i>' . $cmt->ngaythem;
                $output .= '</span>';
                $output .= '</div>';
                $output .= '<div class="mt-2 fz-13 fw-400 lh-15x text-black">' . $cmt->noidung . '</div>';
                $output .= '<div class="d-flex mt-3">';
                $output .= '<div class="mr-auto">';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</li>';
            }
        }
        echo $output;
    }
    public function send_vote(Request $request)
    {
        $cus_id = Session::get('cus_id');
        $check_vote = Rating::where('u_id', $cus_id)->where('truyen_id', $request->truyen_id)->first();
        $output = '';
        if (isset($check_vote)) {
            $check_vote->sosao = $request->rate;
            $check_vote->noidung = $request->vote_content;
            $check_vote->save();

            $rating = Rating::where('truyen_id', $request->truyen_id)->avg('sosao');
            $rate_x = round($rating, 2);
            $truyen = Book::find($request->truyen_id);
            $truyen->sosao = $rate_x + 0.0000001;
            $truyen->save();
        } else {
            $vote = new Rating();
            $user = Account::find($cus_id);
            $vote->u_id = $request->u_id;
            $vote->truyen_id = $request->truyen_id;
            $vote->sosao = ($request->rate) + 0.00001;
            $vote->avt = $user->avatar;
            $vote->ten = $user->username;
            $vote->noidung = $request->vote_content;
            $vote->trangthai = 1;
            $vote->save();

            $rating = Rating::where('truyen_id', $request->truyen_id)->avg('sosao');
            $rate_x = round($rating, 2);
            $truyen = Book::find($request->truyen_id);
            $truyen->sosao = $rate_x + 0.0000001;

            $truyen->sodanhgia += 1;
            $truyen->save();
        }
        $output .= '<div class="alert-form" >';
        $output .= '<div id="toast-container" class="toast-top-right">';
        $output .= '<div class="alert toast toast-success" aria-live="polite">';
        $output .= '<div class="toast-message fz-14"> Bạn đánh giá truyện này thành công!</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        echo $output;
    }
    public function delete_vote(Request $request)
    {
        $vote_id = $request->vote_id;
        $vote = Rating::find($vote_id);
        $vote->delete();
        $rating = Rating::where('truyen_id', $request->truyen_id)->avg('sosao');
        $rate_x = round($rating, 2);
        $truyen = Book::find($request->truyen_id);
        $truyen->sosao = $rate_x + 0.0000001;

        $truyen->sodanhgia -= 1;
        $output = '';
        $output .= '<div class="alert-form" >';
        $output .= '<div id="toast-container" class="toast-top-right">';
        $output .= '<div class="alert toast toast-success" aria-live="polite">';
        $output .= '<div class="toast-message fz-14"> Bạn xóa thành công!</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $truyen->save();
        echo $output;
    }
    public function load_vote(Request $request)
    {
        $truyen_id = $request->truyen_id;
        $cus_id = Session::get('cus_id');
        $limit = $request->limit;
        $start = $request->start;

        $vote = Rating::where('truyen_id', $truyen_id)->orderBy('id', 'DESC')
            ->skip($start)
            ->take($limit)->get();
        $output = '';
        if (!$vote->isEmpty()) {
            foreach ($vote as $key => $val) {
                // $last_id = $cmt->id;

                $output .= '<li class="vote_x comment-items media py-3 border-bottom">';
                $output .= '<div class=" nh-avatar--45 mr-3 position-relative" style="cursor: pointer;">';
                $output .= '<img alt="" class="br-50 img-fluid size-45" src="' . url('public/uploads/cus_avt/') . '/' . $val->account->avatar . '">';
                $output .= '</div>';
                $output .= '<div class="media-body">';
                $output .= '<div class="d-flex">';
                $output .= '<a href="" class="d-inline-block h5 mb-0 fz-15 mr-2 fw-600">' . $val->account->username . '</a>';
                $output .= '<span class="date_vote_1 d-flex align-items-center text-tertiary fz-15">';
                $output .= '<i class="nh-icon ti-timer mr-2 "></i>' . $val->ngaydang;
                $output .= '</span>';
                $output .= '</div>';
                $output .= '<div class="d-flex" style="justify-content: space-between;">';
                $output .= '<span class="d-flex align-items-center text-tertiary fz-15">';
                $output .= '<ul class="list-inline d-flex position-relative rating mb-0 mt-1">';
                $output .= '<li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc1052e ; font-size: 15px;">&#9733</li>';
                $output .= '<ul class="d-flex active" style="width: ' . ($val->sosao * 100 / 5) . '%;">';
                $output .= '<li class="mr-1" style="color:#ffc000 ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc000 ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc000 ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc000 ; font-size: 15px;">&#9733</li>';
                $output .= '<li class="mr-1" style="color:#ffc000 ; font-size: 15px;">&#9733</li>';
                $output .= '</ul>';
                $output .= '</ul>';
                $output .= '</span>';
                if ($cus_id == $val->u_id) {
                    $output .= '<span class="delete_vote_btn"  data-vote_id="' . $val->id . '">';
                    $output .= '<a class="text-secondary">';
                    $output .= '<i class="ti-trash"></i>';
                    $output .= '</a>';
                    $output .= '</span>';
                }
                $output .= '</div>';
                $output .= '<div class="mt-2 fz-15 fw-400 lh-15x text-black">' . $val->noidung . '</div>';
                $output .= '<div class="date_vote_2 mt-2 fz-15 fw-400 lh-15x text-tertiary"><i class="nh-icon ti-timer mr-2 "></i>' . $val->ngaydang . '</div>';
                $output .= '</div>';
                $output .= '</li>';
            }
        }
        echo $output;
    }
    public function load_rating(Request $request)
    {
        $truyen_id = $request->truyen_id;

        $total_rating = Rating::where('truyen_id', $truyen_id)->get();
        $rating = Rating::where('truyen_id', $truyen_id)->avg('sosao');

        $rate_x = round($rating, 2);

        $output = '';
        $output .= '<ul class="list-inline d-flex position-relative rating mb-0">';
        $output .= '<li style="color:#ffc1052e ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc1052e ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc1052e ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc1052e ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc1052e ; font-size: 30px;">&#9733</li>';
        $output .= '<ul class="d-flex active" style="width: ' . ($rating * 100 / 5) . '%;">';
        $output .= '<li style="color:#ffc000 ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc000 ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc000 ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc000 ; font-size: 30px;">&#9733</li>';
        $output .= '<li style="color:#ffc000 ; font-size: 30px;">&#9733</li>';
        $output .= '</ul>';
        $output .= '</ul>';
        $output .= '<span class="detail_vote d-inline-block ml-2 fz-16">';
        $output .= '<span class="fw-500 fz-16 mr-2">' . $rate_x . '/5 </span> ';
        $output .= '</span>';
        $output .= '<span class="detail_vote d-inline-block fz-16 text-secondary ml-1"> (' . count($total_rating) . ' đánh giá)</span>';
        echo $output;
    }
    public function nominate_send(Request $request)
    {
        $truyen_id = $request->truyen_id;
        $cus_id = Session::get('cus_id');

        $account = Account::where('id', $cus_id)->first();
        $sohoacon = $account->sohoa;
        $output = '';

        if ($sohoacon > 0) {
            $truyen = Book::find($truyen_id);
            $truyen->luotdecu += 1;
            $account->sohoa -= 1;
            $output .= '<div class="alert-form" >';
            $output .= '<div id="toast-container" class="toast-top-right">';
            $output .= '<div class="alert toast toast-success" aria-live="polite">';
            $output .= '<div class="toast-message fz-14"> Bạn đề cử thành công!</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
            $truyen->save();
            $account->save();
        } else {
            $output .= '<div class=" alert-form" >';
            $output .= '<div id="toast-container" class="toast-top-right">';
            $output .= '<div class="alert toast toast-error" aria-live="polite">';
            $output .= '<div class="toast-message fz-14"> Bạn hết hoa mất rồi!</div>';
            $output .= '</div>';
            $output .= '</div>';
            $output .= '</div>';
        }
        echo $output;
    }
    public function timkiem()
    {
        $cus_id = Session::get('cus_id');
        $current_page = URL::current();
        Session::put('current_page', $current_page);

        $theloai = Category::where('trangthai', 0)->orderBy('tentheloai', 'ASC')->get();
        $slide = SlideModel::all()->where('trangthai', 0)->random();
        $tinhcach = Personality::where('trangthai', 0)->orderBy('tentinhcach', 'ASC')->get();
        $luuphai = Sect::where('trangthai', 0)->orderBy('tenluuphai', 'ASC')->get();
        $thegioi = World::where('trangthai', 0)->orderBy('tenthegioi', 'ASC')->get();

        $tukhoa = trim($_GET['tukhoa']);
        $token = csrf_token();
        $truyen = Book::where('trangthai', '1')
            ->where(function ($query) {
                $tukhoa = trim($_GET['tukhoa']);
                $query->where('tentruyen', 'LIKE', '%' . $tukhoa . '%')
                    ->orWhere('tacgia', 'LIKE', '%' . $tukhoa . '%');
            })
            ->paginate(28);
        for ($i = 0; $i <= count($truyen) - 1; $i++) {
            $count_chapter_x[$i] = Chapter::where('truyen_id', $truyen[$i]->id)->get();
            $count_chap_x[$i] = count($count_chapter_x[$i]);
        }
        $html = ' <div class="col l-12 w-100 pagi-nav">' . $truyen->onEachSide(2)
            ->appends(['_token' => $token])
            ->appends(['tukhoa' => $tukhoa])
            ->links('pagination::bootstrap-4') . '</div>';
        /*********************SEO********************* */
        $title = 'Truyện Convert - Đọc Truyện Online Miễn Phí | Truyện CV - TruyenCV';
        $meta_desc = 'Truyện Convert là nền tảng đọc truyện online miễn phí hàng đầu hiện nay, kho truyện convert với nhiều thể loại truyện tiên hiệp, truyện kiếp hiệp, truyện huyền huyễn, truyện tu luyện, truyện tu chân.';
        $meta_keywords = 'truyen convert, truyen dich, truyen kiem hiep, truyen ngon tinh, truyen full, truyen hoan thanh, truyen tien hiep, truyen lich su, truyen do thi';
        $og_image = url('public/uploads/logo/logo-1.png');
        $meta_tag = 'doc truyen, doc truyen online, truyen hay, truyen full, truyen convert, truyen dich, truyen ngon tinh, truyen sang tac, kiem hiep, tien hiep, ngon tinh, do thi, huyen huyen, lich su';
        /*********************END SEO********************* */
        return view('home.search.search')->with(compact(
            'slide',
            'theloai',
            'tinhcach',
            'luuphai',
            'thegioi',
            'truyen',
            'count_chap_x',
            'tukhoa',
            'html',
            'meta_desc',
            'meta_keywords',
            'og_image',
            'title',
            'meta_tag'
        ));
    }
}
