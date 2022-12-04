<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TickBook extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'truyen_id', 'chuong_id', 'chuong_slug', 'u_id', 'hinhanh', 'tentruyen'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_tickbook';
    public function truyen()
    {
        return $this->belongsTo('App\Models\Book', 'truyen_id', 'id');
    }
}
