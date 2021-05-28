<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $primaryKey = 'id_komentar';
    public $incrementing = false;
    protected $table = 'komentar';
    protected $fillable = ['id_komentar','id_posting','komentar','suka','id_admin','created_at','updated_at'];

    public function posing() {
       return $this->belongsTo('App\Posting', 'id_posting');
    }

    public function mimin() {
       return $this->belongsTo('App\Admin', 'id_admin');
    }
}
