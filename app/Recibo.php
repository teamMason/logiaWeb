<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Recibo extends Model
{
    //
     protected $table = 'recibo';

     public function taller()
    {
        return $this->belongsTo(Taller::class);
    }
}
