<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
	  /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contacto';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'email', 'telefono', 'comentario'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
    //
}
