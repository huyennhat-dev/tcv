<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Faq;
use App\Models\Rating;
use App\Models\SlideModel;
use Illuminate\Http\Request;

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

        $booknew = Book::where('trangthai', 1)->orderBy('ngaydang', 'DESC')->paginate(10);
        foreach ($booknew as $val) {
            $chuongmoinhat = Chapter::where('trangthai', 1)
            ->where('truyen_id', $val['id'])
            ->orderBy("slug", "desc")->first();
            $newbook = [
                "id" => $val['id'],
                "tentruyen" => $val['tentruyen'],
                "hinhanh" => $val['hinhanh'],
                "chuongmoinhat"=>(int) $chuongmoinhat['slug']
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
    public function banner()
    {
        $book = Book::where('trangthai', 1)->inRandomOrder()->limit(9)->get();
        $data = [];

        foreach ($book as $val) {
            $chuongmoinhat = Chapter::where('trangthai', 1)->where('truyen_id', $val['id'])->orderBy("slug", "desc")->first();
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
            array_push($data, $banner);
        }
        return response()->json($data);
    }

    public function bookNewUpdate()
    {
        $chap_moi = Chapter::with('truyen')
            ->select('*')
            ->where('trangthai', 1)
            ->orderBy('ngaydang', 'DESC')
            ->get()->unique('truyen_id')->take(15);
        $data = [];
        foreach ($chap_moi as $val) {
            $book = [
                "id" => $val['truyen_id'],
                "tentruyen" => $val['truyen']['tentruyen'],
                "hinhanh" => $val['truyen']['hinhanh'],
                "chuongmoinhat" => (int) $val['slug']
            ];
            array_push($data, $book);
        }
        return response()->json($data);
    }


    public function topVote()
    {
        $truyen = Book::where('trangthai', 1)->orderBy('luotdecu', 'DESC')->get()->take(15);

        $data = [];
        foreach ($truyen as $val) {
            $book = [
                "id" => $val['id'],
                "tentruyen" => $val['tentruyen'],
                "hinhanh" => $val['hinhanh']
            ];
            array_push($data, $book);
        }
        return response()->json($data);
    }

    public function recentReview()
    {
        $vote = Rating::select('*')->where('trangthai', 1)->orderBy('id', 'DESC')->get()->unique('truyen_id')->take(10);
        return $vote;
    }
}
