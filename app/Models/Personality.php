<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personality extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'tentinhcach', 'slug', 'trangthai'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_personality';
    public function truyen()
    {
        return $this->hasMany('App\Models\Truyen');
    }
}
