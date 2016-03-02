<?php

namespace portalLogia;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{

    public static function getSearchMiembros($search, $grado)
    {

        if($search != null  and $grado != 0)
        {


            return \DB::table('libros')
                ->where('titulo', "LIKE","%$search%")
                ->where(function ($query) use ($grado) {
                    $query->where("grado", $grado);

                })
                ->orderBy('autor', 'asc')
                ->paginate(50);
        }
        elseif($search != null and $grado == 0)
        {
            return \DB::table('libros')
                ->where('titulo', "LIKE","%$search%")
                ->orWhere('autor', "LIKE","%$search%")
                ->orderBy('autor', 'asc')
                ->paginate(50);

        }


    }
}
