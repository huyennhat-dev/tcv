<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'send_id', 'receive_id', 'noidung', 'ngaygui', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_mail';
    public function nguoigui()
    {
        return $this->belongsTo('App\Models\Account', 'send_id', 'id');
    }
}
