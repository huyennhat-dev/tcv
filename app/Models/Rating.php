<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'truyen_id', 'sosao', 'u_id', 'avt', 'ten', 'noidung', 'ngaydang', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_rating';
    public function truyen()
    {
        return $this->belongsTo('App\Models\Book', 'truyen_id', 'id');
    }
    public function account()
    {
        return $this->belongsTo('App\Models\Account', 'u_id', 'id');
    }
}
