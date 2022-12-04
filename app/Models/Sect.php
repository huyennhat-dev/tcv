<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sect extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'tenluuphai', 'slug', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_sect';
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen');
    }
}
