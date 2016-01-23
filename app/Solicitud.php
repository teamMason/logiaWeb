<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
	protected $table = 'solicitudes';
    protected $fillable = ['path'];
   /* public function setPathAttribute($path){
        $name = Carbon::now()->second.$path->getClientOriginalName();
        $this->attributes['path'] = $name;
        \Storage::disk('local')->put($name, \File::get($path));
    }*/
}
