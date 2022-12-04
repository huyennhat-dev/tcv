<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\ReadingBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChapterController extends Controller
{
    public function readChapter($cus_id, $truyen_id, $chapter_slug)
    {

        $readingbook = ReadingBooks::where('truyen_id', $truyen_id)->where('u_id', $cus_id)->first();

        $truyen = Book::where('id', $truyen_id)->first();
        $chuong = Chapter::where('trangthai', 1)->where('truyen_id', $truyen_id)->where('slug', $chapter_slug)->first();

        $book = Book::findOrFail($truyen->id);
        $book->increment('luotxem');
        $luotxem_chuong = Chapter::findOrFail($chuong->id);
        $luotxem_chuong->increment('luotdoc');

        if ($cus_id > 0) {

            if ($readingbook) {
                if ($chuong) {
                    $readingbook->chuong_id = $chuong->id;
                    $readingbook->chuong_slug = $chuong->slug;
                    $readingbook->save();

                    return $chuong;
                } else {
                    return response()->json([
                        'success' => false
                    ]);
                }
            } else {
                $readingbook = new ReadingBooks();
                $readingbook->truyen_id = $truyen->id;
                $readingbook->chuong_id = $chuong->id;
                $readingbook->chuong_slug = $chuong->slug;
                $readingbook->u_id = $cus_id;
                $readingbook->hinhanh = $truyen->hinhanh;
                $readingbook->tentruyen = $truyen->tentruyen;
                $readingbook->save();

                return $chuong;
            }
        } else {

            return $chuong;
        }
    }

    public function listChapter($truyen_id, $sort)
    {
        $listChapter = Chapter::where('trangthai', 1)->where('truyen_id', $truyen_id)->orderBy('slug', $sort)->get();
        return $listChapter;
    }
}
