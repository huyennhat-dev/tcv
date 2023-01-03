<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookComment;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Personality;
use App\Models\Rating;
use App\Models\ReadingBooks;
use App\Models\Sect;
use App\Models\World;
use Illuminate\Http\Request;
use LengthException;

class BookController extends Controller
{
    public function showAllBook()
    {
        return Book::all();
    }

    public function showBookDetail($uid, $id)
    {

        $book = Book::where('trangthai', 1)->where('id', $id)->first();
        $category = Category::find($book['theloai_id']);
        $sect = Sect::find($book['luuphai_id']);
        $world = World::find($book['thegioi_id']);
        $personality = Personality::find($book['tinhcach_id']);

        $loadchapter = Chapter::where('trangthai', 1)->where('truyen_id', $id)->orderBy('slug', 'ASC')->get();
        $chapters = [];
        foreach ($loadchapter as $val) {

            $chapter = [
                'chuongid' => $val['id'],
                'tenchuong' => $val['tenchuong'],
                'slug' => $val['slug']
            ];
            array_push($chapters, $chapter);
        }

        $loadrate = Rating::where('truyen_id', $book['id'])->orderBy('id', 'DESC')->limit(3)->get();

        $rates = [];

        foreach ($loadrate as $val) {
            $rate = [
                'rateid' => $val['id'],
                'truyen_id' => $val['truyen_id'],
                'username' => $val['ten'],
                'sosao' => $val['sosao'],
                'uid' => $val['u_id'],
                'content' => $val['noidung'],
                'photo' => $val['avt'],
                'ngaydang' => $val['ngaydang']
            ];
            array_push($rates, $rate);
        }

        $history_book = ReadingBooks::where('truyen_id', $id)->where('u_id', $uid)->first();
        $chuong_slug = $history_book != null ? $history_book['chuong_slug'] : 0;

        $data = [
            'id' => $book['id'],
            'tentruyen' => $book['tentruyen'],
            'hinhanh' => $book['hinhanh'],
            'slug' => $book['slug'],
            'mota' => $book['mota'],
            'tacgia' => $book['tacgia'],
            'hinhanh' => $book['hinhanh'],
            'luotxem' => $book['luotxem'],
            'ngaydang' => $book['ngaydang'],
            'chuongslug' => $chuong_slug,
            'thoigiancapnhat' => $book['thoigiancapnhat'],
            'sosao' => $book['sosao'],
            'sochuong' => $book['sochuong'],
            'tinhtrang' => $book['tinhtrang'],
            'trangthai' => $book['trangthai'],
            'theloai' => $category['tentheloai'],
            'tinhcach' => $personality['tentinhcach'],
            'thegioi' => $world['tenthegioi'],
            'luuphai' => $sect['tenluuphai'],
            'danhsachchuong' => $chapters,
            'topdecu' => $rates
        ];
        return response()->json(
            $data
        );
    }

    public function historyReadBook($cus_id)
    {
        $books =  ReadingBooks::where('u_id', $cus_id)->orderBy('id', 'DESC')->simplePaginate(20);
        $datas = [];
        $array = $books->toArray();
        foreach ($array['data'] as $item) {
            $book = Book::where('trangthai', 1)->where('id', $item['truyen_id'])->first();
            $theloai = Category::find($book['theloai_id']);
            $data = [
                "id" => $item['id'],
                "tentruyen" => $book['tentruyen'],
                "hinhanh" => $book['hinhanh'],
                "tacgia" => $book['tacgia'],
                "theloai" => $theloai['tentheloai'],
                "truyen_id" => $item['truyen_id'],
                "chuong_slug" => $item['chuong_slug'],
                'tongsochuong' => $book['sochuong']
            ];
            array_push($datas, $data);
        }
        return response()->json($datas);
    }

    public function deleteHistory($id)
    {
        ReadingBooks::where('id', $id)->delete();
        return response()->json(
            ["success" => true]
        );
    }
}
