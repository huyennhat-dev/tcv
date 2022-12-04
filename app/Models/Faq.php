<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'cauhoi', 'cautraloi', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_faq';
}
