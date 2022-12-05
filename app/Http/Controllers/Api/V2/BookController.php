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
                'slug'=>$val['slug']
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
                'ngaydang'=>$val['ngaydang']
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

    public function loadRating($truyen_id)
    {
        $loadRatingBook = Rating::where('truyen_id', $truyen_id)->orderBy('id', 'DESC')->get();
        return response()->json([
            'data' => $loadRatingBook
        ]);;
    }

    public function postRating(Request $request)
    {
        $input = $request->all();
        $checkrating = Rating::where('truyen_id', $input['truyenId'])->where('u_id', $input['cusId'])->first();
        if ($checkrating == null) {

            $rating = new Rating();
            $rating->truyen_id = $input['truyenId'];
            $rating->avt = $input['image'];
            $rating->ten = $input['name'];
            $rating->sosao = $input['rate'];
            $rating->u_id = $input['cusId'];
            $rating->noidung = $input['content'];
            $rating->trangthai = 1;
            $rating->save();

            $ratingavg = Rating::where('truyen_id', $input['truyenId'])->avg('sosao');
            $rate_x = round($ratingavg, 2);

            $book = Book::find($input['truyenId']);
            $book->sosao = $rate_x + 0.0000001;

            $book->sodanhgia += 1;
            $book->save();
            return response()->json([
                'addsuccess' => true
            ]);
        } else {
            $checkrating->sosao = $input['rate'];
            $checkrating->noidung = $input['content'];

            $checkrating->save();

            $ratingavg = Rating::where('truyen_id', $input['truyenId'])->avg('sosao');
            $rate_x = round($ratingavg, 2);

            $book = Book::find($input['truyenId']);
            $book->sosao = $rate_x + 0.0000001;
            $book->save();

            return response()->json([
                'addsuccess' => true
            ]);
        }
    }

    public function comment(Request $request)
    {

        $input = $request->all();
        $comment = new BookComment();
        $comment->truyen_id = $input['truyen_id'];
        $comment->u_id = $input['u_id'];
        $comment->noidung = $input['noidung'];
        $comment->save();

        $book = Book::find($input['truyen_id']);
        $book->sobinhluan += 1;
        $book->save();
    }

    public function load_comment($truyen_id)
    {
        $comment = BookComment::where('truyen_id', $truyen_id)->orderBy('id', 'DESC')->paginate(10);
        return $comment;
    }
}
