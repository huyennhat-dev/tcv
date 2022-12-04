<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookComment extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'truyen_id', 'u_id', 'noidung', 'ten', 'hinhanh', 'ngaythem'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_book_comment';
     public function user()
    {
        return $this->belongsTo('App\Models\Account', 'u_id', 'id');
    }
}
