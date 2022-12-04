<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'email', 'username', 'password', 'numberphone', 'avatar',
        'yearofbirth', 'sex', 'introduce', 'lever', 'joindate', 'sohoa'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_account';
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen');
    }
    public function vote()
    {
        return $this->hasMany('App\Models\Rating');
    }
    public function book_cmt()
    {
        return $this->hasMany('App\Models\BookComment');
    }
    public function chap_cmt()
    {
        return $this->hasMany('App\Models\ChapterComment');
    }
    public function chat()
    {
        return $this->hasMany('App\Models\Chat');
    }
}
