<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideModel extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'hinhanh', 'mota', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_slide';
}
