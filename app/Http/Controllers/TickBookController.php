<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ReadingBooks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\TickBook;

class TickBookController extends Controller
{
    public function load_tickbook(Request $request)
    {
        $u_id = $request->u_id;
        $truyen_id = $request->truyen_id;

        $tickbook = TickBook::where('truyen_id', $truyen_id)->where('u_id', $u_id)->get();
        $output = '';
        if (count($tickbook) < 1 || empty($tickbook)) {
            $output .=  '<a href="javascript:void(0);"  id="tickbook_btn" class="border fz-14 btn-outline-secondary btn-md btn-block fw-600 d-flex align-items-center justify-content-center">';
            $output .= '<i class="nh-icon ti-bookmark"></i> Đánh dấu';
            $output .= '</a>';
        } else {
            $output .= '<a href="javascript:void(0);"  id="del_tickbook_btn" class="border fz-14 btn-secondary btn-md btn-block fw-600 d-flex align-items-center justify-content-center">';
            $output .= '<i class="nh-icon ti-bookmark"></i> Bỏ đánh dấu';
            $output .= '</a>';
        }
        echo $output;
    }

    public function store(Request $request)
    {
        $u_id = $request->u_id;
        $truyen_id = $request->truyen_id;

        $truyen = Book::where('id', $truyen_id)->first();

        $tickbook = new TickBook();
        $tickbook->u_id = $u_id;
        $tickbook->truyen_id = $truyen_id;
        $tickbook->tentruyen = $truyen->tentruyen;
        $tickbook->hinhanh = $truyen->hinhanh;

        $checkReadingBook = ReadingBooks::where('truyen_id', $request->truyen_id)->where('u_id', $u_id)->first();
        if ($checkReadingBook != null) {
            $tickbook->chuong_id = $checkReadingBook->chuong_id;
            $tickbook->chuong_slug = $checkReadingBook->chuong_slug;
        } else {
            $tickbook->chuong_id = 1;
            $tickbook->chuong_slug = 1;
        }

        $output = '';
        $output .= '<div class="alert-form" >';
        $output .= '<div id="toast-container" class="toast-top-right">';
        $output .= '<div class="alert toast toast-success" aria-live="polite">';
        $output .= '<div class="toast-message fz-14"> Bạn đánh dấu thành công!</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $tickbook->save();
        echo $output;
    }
    public function destroy(Request $request)
    {

        $u_id = $request->u_id;
        $truyen_id = $request->truyen_id;
        $tickbook = TickBook::where('u_id', $u_id)->where('truyen_id', $truyen_id)->first();
        $tickbook->u_id = $u_id;
        $tickbook->truyen_id = $truyen_id;
        $output = '';
        $output .= '<div class="alert-form" >';
        $output .= '<div id="toast-container" class="toast-top-right">';
        $output .= '<div class="alert toast toast-success" aria-live="polite">';
        $output .= '<div class="toast-message fz-14"> Bạn bỏ đánh dấu thành công!</div>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        $tickbook->delete();
        echo $output;
    }
}
