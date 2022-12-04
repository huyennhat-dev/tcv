<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class World extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'tenthegioi', 'slug', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_world';
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen');
    }
}
