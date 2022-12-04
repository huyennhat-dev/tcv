<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'tentheloai', 'slug', 'mota', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_category';
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen');
    }
}
