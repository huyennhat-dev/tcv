<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookComment;
use App\Models\Rating;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function showAllBook()
    {
        return Book::all();
    }

    public function showBookById($id)
    {
        return Book::find($id);
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
