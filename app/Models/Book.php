<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'tentruyen', 'hinhanh', 'slug', 'mota',
        'nguoidang_id', 'tacgia', 'phanloai',
        'theloai_id', 'tinhcach_id', 'luuphai_id', 'thegioi_id',
        'luotxem', 'luotdecu', 'sobinhluan',
        'sodanhgia', 'sosao', 'ngaydang',
        'thoigiancapnhat', 'tinhtrang', 'trangthai', 'sochuong'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_book';
    public function theloai()
    {
        return $this->belongsTo('App\Models\Category', 'theloai_id', 'id');
    }
    public function nguoidang()
    {
        return $this->belongsTo('App\Models\Account', 'nguoidang_id', 'id');
    }
    public function chapter()
    {
        return $this->hasMany('App\Models\Chapter', 'truyen_id', 'id');
    }
    public function tinhcach()
    {
        return $this->belongsTo('App\Models\Personality', 'tinhcach_id', 'id');
    }
    public function thegioi()
    {
        return $this->belongsTo('App\Models\World', 'thegioi_id', 'id');
    }
    public function luuphai()
    {
        return $this->belongsTo('App\Models\Sect', 'luuphai_id', 'id');
    }
    public function rating()
    {
        return $this->hasMany('App\Models\Rating', 'truyen_id', 'id');
    }
}
