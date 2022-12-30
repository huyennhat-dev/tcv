<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookComment;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\Personality;
use App\Models\Rating;
use App\Models\Readbook;
use App\Models\ReadingBooks;
use App\Models\Sect;
use App\Models\World;
use Illuminate\Http\Request;
use LengthException;

class ChapterController extends Controller
{

    public function listChapter($truyen_id,)
    {
        $listChapter = Chapter::where('trangthai', 1)->where('truyen_id', $truyen_id)->orderBy('slug', "ASC")->get();
        $datas = [];
        foreach ($listChapter as $val) {
            $data = [
                'chuongid' => $val['id'],
                'tenchuong' => $val['tenchuong'],
                'slug' => $val['slug']
            ];
            array_push($datas, $data);
        }

        return response()->json($datas);
    }

    public function loadChapter($id,)
    {
        $chapter = Chapter::find($id);
        return response()->json($chapter);
    }

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
            $newReadBook = new Readbook();
            $newReadBook->truyen_id = $truyen_id;
            $newReadBook->u_id = $cus_id;
            $newReadBook->chapter_id = $chuong['id'];
            $newReadBook->theloai_id = $book['theloai_id'];
            $newReadBook->ngaythem = date("Y-m-d");

            $newReadBook->save();

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

}
