<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'u_id', 'noidung', 'ngaydang'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_chat';
    public function user()
    {
        return $this->belongsTo('App\Models\Account', 'u_id', 'id');
    }
}
