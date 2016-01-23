<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    protected $table = 'taller';

    public function miembros()
    {
        return $this->hasOne(Miembros::class);
    }

    public function recibo()
    {
        return $this->hasMany(Recibo::class);
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitudes::class);
    }
}
