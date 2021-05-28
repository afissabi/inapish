<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $primaryKey = 'id_tentang';
    public $incrementing = false;
    protected $table = 'tentang';
    protected $fillable = ['id_tentang','id_admin','foto_profil','tentang','created_at','updated_at'];

    public function mimin() {
       return $this->belongsTo('App\Admin', 'id_admin');
    }
}
