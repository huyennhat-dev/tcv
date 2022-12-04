<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ReadingBooks;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index($cus_id)
    {
        $history =  ReadingBooks::where('u_id', $cus_id)->orderBy('id', 'DESC')->paginate(10);

        return $history;
    }
    public function deleteHistory($id, $cus_id)
    {
        $history = ReadingBooks::where('u_id', $cus_id)->where('id', $id)->first();
        $history->delete();
    }
}
