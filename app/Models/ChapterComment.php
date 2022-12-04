<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterComment extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'noidung', 'ngaythem', 'truyen_id', 'u_id', 'chuong_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_chapter_comment';
    public function user_2()
    {
        return $this->belongsTo('App\Models\Account', 'u_id', 'id');
    }
}
