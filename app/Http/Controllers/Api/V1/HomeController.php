<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Book;
use App\Models\Category;
use App\Models\Faq;
use App\Models\SlideModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function slide()
    {
        $slide = SlideModel::all()->where('trangthai', 0)->random(6);
        return $slide;
    }

    public function latestNovel()
    {
        $latestNovel = Book::where('trangthai', 1)->orderBy('thoigiancapnhat', 'DESC')->paginate(10);
        return $latestNovel;
    }
    public function nominations()
    {
        $nominations = Book::where('trangthai', 1)->inRandomOrder()->limit(6)->get();
        return $nominations;
    }

    public function popular()
    {
        $popular = Book::where('trangthai', 1)->orderBy('luotxem', 'DESC')->paginate(9);
        return $popular;
    }
    public function justPosted()
    {
        $justPosted = Book::where('trangthai', 1)->orderBy('ngaydang', 'DESC')->paginate(10);
        return $justPosted;
    }
    public function justFinished()
    {
        $justFinished = Book::where('tinhtrang', 1)->orderBy('luotxem', 'DESC')->paginate(9);
        return $justFinished;
    }

    public function search_book()
    {
        $tukhoa = trim($_GET['tukhoa']);
        if ($tukhoa != null) {
            $truyen = Book::where('trangthai', '1')
                ->where(function ($query) {
                    $tukhoa = trim($_GET['tukhoa']);
                    $query->where('tentruyen', 'LIKE', '%' . $tukhoa . '%')
                        ->orWhere('tacgia', 'LIKE', '%' . $tukhoa . '%');
                })
                ->get();

            return $truyen;
        }else{
            $truyen = [];
            return $truyen;

        }
    }

    public function fetchBook($slug)
    {
        if ($slug == 'fetch_all_book') {
            $book = Book::where('trangthai', 1)->paginate(10);
        } else if ($slug == 'new_book') {
            $book = Book::where('trangthai', 1)->orderBy('thoigiancapnhat', 'DESC')->paginate(10);
        } else if ($slug == 'nomination') {
            $book = Book::where('trangthai', 1)->orderBy('luotdecu', 'DESC')->paginate(10);
        } else if ($slug == 'popular') {
            $book = Book::where('trangthai', 1)->orderBy('luotxem', 'DESC')->paginate(10);
        } else if ($slug == 'just_posted') {
            $book = Book::where('trangthai', 1)->orderBy('ngaydang', 'DESC')->paginate(10);
        } else if ($slug == 'just_finished') {
            $book = Book::where('trangthai', 1)->where('tinhtrang', 1)->orderBy('luotxem', 'DESC')->paginate(9);
        }
        return $book;
    }

    public function loadQues()
    {
        $ques = Faq::all();
        return $ques;
    }

    public function fetchCategory($id){
        $category = Category::find($id);
        return $category;
    }
}
