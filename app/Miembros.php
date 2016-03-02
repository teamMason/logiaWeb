<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;


class Miembros extends Model
{
    //
    public $timestamps = false;

    protected $table = 'miembros';

    protected $fillable = ['nombre, apellido, email'];






}

