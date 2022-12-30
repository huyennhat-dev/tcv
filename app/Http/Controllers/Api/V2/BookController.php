<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookComment;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Personality;
use App\Models\Rating;
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

    public function showBookDetail($id)
    {

        $book = Book::find($id);
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


}
