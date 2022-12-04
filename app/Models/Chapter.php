<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'truyen_id', 'tenchuong', 'slug', 'noidung', 'ngaydang', 'luotdoc', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_chapter';
    public function truyen()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
