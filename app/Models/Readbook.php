<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readbook extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'truyen_id', 'theloai_id', 'chapter_id', 'u_id', 'ngaythem'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_readbook';
}
