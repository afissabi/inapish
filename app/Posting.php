<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posting extends Model
{
    protected $primaryKey = 'id_posting';
    public $incrementing = false;
    protected $table = 'posting';
    protected $fillable = ['id_posting','id_admin','foto','caption','ijin_komen','ijin','created_at','updated_at'];

    public function mimin() {
       return $this->belongsTo('App\Admin', 'id_admin');
    }
}
