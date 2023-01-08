<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Book;
use App\Models\BookComment;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Personality;
use App\Models\Rating;
use App\Models\Readbook;
use App\Models\ReadingBooks;
use App\Models\Sect;
use App\Models\TickBook;
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
        $bookmark = TickBook::where('u_id', $uid)->where('truyen_id', $id)->first();

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
            'bookmark' => $bookmark ? true : false,
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
        if ($cus_id > 0) {
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
    }

    public function deleteHistory($id)
    {
        ReadingBooks::where('id', $id)->delete();
        return response()->json(
            ["success" => true]
        );
    }

    public function bookMark(Request $req)
    {
        $input = $req->all();

        $checkTickbook = TickBook::where('u_id', $input['cus_id'])
            ->where('truyen_id', $input['truyen_id'])->first();
        if ($checkTickbook != null) {
            $checkTickbook->delete();

            return response()->json([
                'success' => false
            ]);
        } else {
            $book = Book::where('trangthai', 1)
                ->where('id', $input['truyen_id'])->first();
            $readingbook = ReadingBooks::where('u_id', $input['cus_id'])
                ->where('truyen_id', $input['truyen_id'])->first();

            $tickBook = new TickBook();
            $tickBook->truyen_id = $input['truyen_id'];
            $tickBook->u_id = $input['cus_id'];

            $tickBook->hinhanh = $book['hinhanh'];
            $tickBook->tentruyen = $book['tentruyen'];

            $tickBook->chuong_id = $readingbook ? $readingbook['chuong_id'] : 1;
            $tickBook->chuong_slug = $readingbook ? $readingbook['chuong_slug'] : 1;
            $tickBook->save();
            return response()->json([
                'success' => true
            ]);
        }
    }

    public function showAllBookMark($cus_id)
    {
        if ($cus_id > 0) {
            $books =  TickBook::where('u_id', $cus_id)->orderBy('id', 'DESC')->simplePaginate(20);
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
    }
    public function delBookMark($id)
    {
        TickBook::where('id', $id)->delete();
        return response()->json(
            ["success" => true]
        );
    }
    public function postRating(Request $request)
    {
        $input = $request->all();
        $checkrating = Rating::where('truyen_id', $input['truyenid'])->where('u_id', $input['uid'])->first();
        if ($checkrating == null) {
            $user = Account::find($input['uid']);

            $rating = new Rating();
            $rating->truyen_id = $input['truyenid'];
            $rating->sosao = $input['rate'] + 0.01;
            $rating->u_id = $input['uid'];
            $rating->noidung = $input['content'];

            $rating->avt = $user['avatar'];
            $rating->ten = $user['username'];
            $rating->trangthai = 1;
            $rating->save();

            $ratingavg = Rating::where('truyen_id', $input['truyenid'])->avg('sosao');
            $rate_x = round($ratingavg, 2);

            $book = Book::find($input['truyenid']);
            $book->sosao = $rate_x + 0.01;

            $book->sodanhgia += 1;
            $book->save();
            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }

    public function delRating($id)
    {
        Rating::where('id', $id)->delete();
        return response()->json(
            ["success" => true]
        );
    }

    public function bookForYou($truyen_id)
    {
        $datas = [];

        $truyen = Book::find($truyen_id);


        $book = Book::where('trangthai', 1)
            ->where('id', '!=', $truyen_id)
            ->where('theloai_id', $truyen['theloai_id'])
            ->orderBy('luotxem', 'desc')
            ->get();

        foreach ($book as $val) {
            $chuongmoinhat = Chapter::where('trangthai', 1)
                ->where('truyen_id', $val['id'])
                ->orderBy("slug", "desc")->first();

            $theloai = Category::find($val['theloai_id']);

            $data = [
                "id" => $val['id'],
                "tentruyen" => $val['tentruyen'],
                "hinhanh" => $val['hinhanh'],
                "tacgia" => $val['tacgia'],
                "chuongmoinhat" => (int) $chuongmoinhat['slug'],
                "sosao" => $val['sosao'],
                "theloai" => $theloai['tentheloai'],
                "mota" => $val['mota'],
                "luotxem" => $val['luotxem']
            ];
            array_push($datas, $data);
        }

        if (count($book) < 15) {
            $bookrand = Book::where('trangthai', 1)
                ->where('theloai_id', '!=', $truyen['theloai_id'])
                ->orderBy('luotxem', 'desc')
                ->get();


            foreach ($bookrand as $val) {
                $chuongmoinhat = Chapter::where('trangthai', 1)
                    ->where('truyen_id', $val['id'])
                    ->orderBy("slug", "desc")->first();

                $theloai = Category::find($val['theloai_id']);

                $datar = [
                    "id" => $val['id'],
                    "tentruyen" => $val['tentruyen'],
                    "hinhanh" => $val['hinhanh'],
                    "tacgia" => $val['tacgia'],
                    "chuongmoinhat" => (int) $chuongmoinhat['slug'],
                    "sosao" => $val['sosao'],
                    "theloai" => $theloai['tentheloai'],
                    "mota" => $val['mota'],
                    "luotxem" => $val['luotxem']
                ];
                array_push($datas, $datar);
            }
        }


        return response()->json([
            "tentruyen" => $truyen['tentruyen'],
            "x"=>count($datas),
            "data" => $datas
        ]);
    }
}
