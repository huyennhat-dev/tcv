<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TickBook;
use Illuminate\Http\Request;

class TickBookController extends Controller
{
    public function tickBook(Request $request)
    {
        $input = $request->all();

        $checkTickbook = TickBook::where('u_id', $input['cus_id'])->where('truyen_id', $input['truyen_id'])->first();
        if ($checkTickbook != null) {
            $checkTickbook->delete();

            return response()->json([
                'delsuccess' => true
            ]);
        } else {
            $tickBook = new TickBook();
            $tickBook->truyen_id = $input['truyen_id'];
            $tickBook->u_id = $input['cus_id'];
            $tickBook->hinhanh = $input['hinhanh'];
            $tickBook->tentruyen = $input['tentruyen'];
            $tickBook->chuong_id = $input['chapter_id'];
            $tickBook->chuong_slug = $input['chapter_slug'];
            $tickBook->save();
            return response()->json([
                'addsuccess' => true
            ]);
        }
    }

    public function showTickBookByCusId($cus_id)
    {
        $thickBook = TickBook::where('u_id', $cus_id)->orderBy('id', 'DESC')->paginate(10);
        return $thickBook;
    }
    public function checkTickBook($cus_id, $truyen_id)
    {
        $tickbook = TickBook::where('u_id', $cus_id)->where('truyen_id', $truyen_id)->first();
        if ($tickbook) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false
            ]);
        }
    }
    public function deleteTickbook($id, $cus_id)
    {
        $tickBook = TickBook::where('u_id', $cus_id)->where('id', $id)->first();
        $tickBook->delete();
    }
}
