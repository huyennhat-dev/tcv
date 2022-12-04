<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public $timestamps = false; //set to time false
    protected $fillbable = [
        'email', 'username', 'password'
    ];
    protected $primaryKey = 'id';
    protected $table = 'tbl_admin';
}
