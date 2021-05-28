<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $primaryKey = 'id_admin';
    public $incrementing = false;
    protected $table = 'admin';
    protected $fillable = ['id_admin','user','nama_lengkap','pengguna','sandi','created_at','updated_at'];
}
