<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Faq;
use App\Models\Personality;
use App\Models\Rating;
use App\Models\Readbook;
use App\Models\Sect;
use App\Models\SlideModel;
use App\Models\World;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class HomeController extends Controller
{
    public function getHomePage()
    {
        $banners = [];
        $newbookupdates = [];
        $selectbooks = [];
        $recentreviews = [];
        $newbooks = [];

        $bookrand = Book::where('trangthai', 1)
            ->inRandomOrder()->limit(9)->get();

        foreach ($bookrand as $val) {
            $chuongmoinhat = Chapter::where('trangthai', 1)
                ->where('truyen_id', $val['id'])
                ->orderBy("slug", "desc")->first();
            $banner = [
                'id' => $val['id'],
                'tentruyen' => $val['tentruyen'],
                'hinhanh' => $val['hinhanh'],
                'slug' => $val['slug'],
                'mota' => $val['mota'],
                'tacgia' => $val['tacgia'],
                'hinhanh' => $val['hinhanh'],
                'chuongmoinhat' => (int)$chuongmoinhat['slug']
            ];
            array_push($banners, $banner);
        }

        $chapmoi = Chapter::with('truyen')
            ->select('*')
            ->where('trangthai', 1)
            ->orderBy('ngaydang', 'DESC')
            ->get()->unique('truyen_id')->take(15);

        foreach ($chapmoi as $val) {
            $newbookupdate = [
                "id" => $val['truyen_id'],
                "tentruyen" => $val['truyen']['tentruyen'],
                "hinhanh" => $val['truyen']['hinhanh'],
                "chuongmoinhat" => (int) $val['slug']
            ];
            array_push($newbookupdates, $newbookupdate);
        }

        $bookselects = Book::where('trangthai', 1)
            ->orderBy('luotdecu', 'DESC')->get()->take(15);
        foreach ($bookselects as $val) {
            $selectbook = [
                "id" => $val['id'],
                "tentruyen" => $val['tentruyen'],
                "hinhanh" => $val['hinhanh']
            ];
            array_push($selectbooks, $selectbook);
        }

        $recentreview = Rating::select('*')->where('trangthai', 1)
            ->orderBy('id', 'DESC')->get()
            ->unique('truyen_id')->take(10);

        foreach ($recentreview as $val) {
            $author = Account::find($val['u_id']);
            $book = Book::find($val['truyen_id']);

            $recentreview = [
                "id" => $val['id'],
                "uphoto" => $author['avatar'],
                "username" => $author['username'],
                "truyenid" => $book['id'],
                "tentruyen" => $book['tentruyen'],
                "hinhanh" => $book['hinhanh'],
                "tacgia" => $book['tacgia'],
                "sosao" => $val['sosao'],
                "noidung" => $val['noidung'],
                "ngaydang" => $val['ngaydang']
            ];
            array_push($recentreviews, $recentreview);
        }

        $booknew = Book::where('trangthai', 1)->orderBy('ngaydang', 'DESC')->get()->take(10);
        foreach ($booknew as $val) {
            $chuongmoinhat = Chapter::where('trangthai', 1)
                ->where('truyen_id', $val['id'])
                ->orderBy("slug", "desc")->first();
            $newbook = [
                "id" => $val['id'],
                "tentruyen" => $val['tentruyen'],
                "hinhanh" => $val['hinhanh'],
                "chuongmoinhat" => (int) $chuongmoinhat['slug']
            ];
            array_push($newbooks, $newbook);
        }

        $data = [
            "banner" => $banners,
            "newbookupdate" => $newbookupdates,
            "selectbook" => $selectbooks,
            "recentreview" => $recentreviews,
            "newbook" => $newbooks
        ];
        return response()->json($data);
    }

    public function bookRecommendation($uId)
    {
        $datas = [];
        $theloai_id = 0;
        $current_day = date("Y-m-d");

        function getCateId($arr, $max)
        {
            foreach ($arr as $key => $val) {
                if ($val == $max) return $key;
            }
        }

        $checkUser = Readbook::where("u_id", $uId)->count();

        if ($checkUser > 0) {
            $bookforday = Readbook::all()->where("u_id", $uId)
                ->where("ngaythem", $current_day)
                ->countBy("theloai_id");

            if (count($bookforday) > 0) {
                $theloai_id = getCateId($bookforday, $bookforday->max());
            } else {
                $booknotforday = Readbook::all()->where("u_id", $uId)
                    ->where("ngaythem", '<', $current_day)
                    ->countBy("theloai_id");
                $theloai_id = getCateId($booknotforday, $booknotforday->max());
            }
        } else {
            $bookforday = Readbook::all()
                ->where("ngaythem", $current_day)
                ->countBy("theloai_id");

            if (count($bookforday) > 0) {
                $theloai_id = getCateId($bookforday, $bookforday->max());
            } else {
                $booknotforday = Readbook::all()
                    ->where("ngaythem", '<', $current_day)
                    ->countBy("theloai_id");
                $theloai_id = getCateId($booknotforday, $booknotforday->max());
            }
        }

        $book = Book::where('trangthai', 1)
            ->where('theloai_id', $theloai_id)
            ->orderBy('luotxem', 'desc')
            ->get()->take(15);

        foreach ($book as $val) {
            $chuongmoinhat = Chapter::where('trangthai', 1)
                ->where('truyen_id', $val['id'])
                ->orderBy("slug", "desc")->first();

            $theloai = Category::find($val['theloai_id']);
            $tinhcach = Personality::find($val['tinhcach_id']);
            $luuphai = Sect::find($val['luuphai_id']);
            $thegioi = World::find($val['thegioi_id']);

            $data = [
                "id" => $val['id'],
                "tentruyen" => $val['tentruyen'],
                "hinhanh" => $val['hinhanh'],
                "tacgia" => $val['tacgia'],
                "chuongmoinhat" => (int) $chuongmoinhat['slug'],
                "theloai" => $theloai['tentheloai'],
                "tinhcach" => $tinhcach['tentinhcach'],
                "luuphai" => $luuphai['tenluuphai'],
                "thegioi" => $thegioi['tenthegioi']
            ];
            array_push($datas, $data);
        }

        if (count($book) < 15) {
            $bookrand = Book::all()->where('trangthai', 1)
                ->where('theloai_id', '!=', $theloai_id)
                ->random(15-count($book));

            foreach ($bookrand as $val) {
                $chuongmoinhat = Chapter::where('trangthai', 1)
                    ->where('truyen_id', $val['id'])
                    ->orderBy("slug", "desc")->first();

                $theloai = Category::find($val['theloai_id']);
                $tinhcach = Personality::find($val['tinhcach_id']);
                $luuphai = Sect::find($val['luuphai_id']);
                $thegioi = World::find($val['thegioi_id']);

                $datar = [
                    "id" => $val['id'],
                    "tentruyen" => $val['tentruyen'],
                    "hinhanh" => $val['hinhanh'],
                    "tacgia" => $val['tacgia'],
                    "chuongmoinhat" => (int) $chuongmoinhat['slug'],
                    "theloai" => $theloai['tentheloai'],
                    "tinhcach" => $tinhcach['tentinhcach'],
                    "luuphai" => $luuphai['tenluuphai'],
                    "thegioi" => $thegioi['tenthegioi']
                ];
                array_push($datas, $datar);
            }
        }

        return response()->json($datas);
    }
}
