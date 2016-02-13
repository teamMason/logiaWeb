<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Recibos extends Model
{
     protected $table = 'recibos';
     public $timestamps = false;
     protected $fillable = ['id_taller', 'fecha'];

     public function taller()
    {
        return $this->belongsTo(Talleres::class);
    }
}
