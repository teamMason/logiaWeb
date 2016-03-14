<?php

namespace portalLogia\Http\Controllers;


use portalLogia\Http\Requests;
use Illuminate\Http\Request;
use portalLogia\User;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Http\Requests\contactoRequest;
use portalLogia\Posts;
use portalLogia\Contacto;
use portalLogia\Libro;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class navegacion extends Controller
{
    public function home()
    {
        return view('home');

    }

    public function news()
    {
    	/*$posts = \DB::table('Posts')->orderBy('id','desc')->paginate(7);
        return view('blog.news')
        ->with('posts',$posts);*/

        $posts = \DB::table('posts')->where('estatus', 'publicar')->orderBy('id','desc')->paginate(10);
        return view('blog.news')
        ->with('posts',$posts);       


      

        
    }

    public function article($slug)
    {

        $posts = Posts::findBySlug($slug);
        return view('blog.article')
        ->with('posts', $posts);




    }

    public function tags($tag)
    {
        $posts = Posts::where('tags', 'LIKE','%'.$tag.'%')->orderBy('id','desc')->get();
        return view('blog.tags')
        ->with('posts', $posts)->with('tag', $tag);
    }


    //contacto

    public function guardarContacto(contactoRequest $request)
    {
        $c = Contacto::Create($request->all());
        $c->nombre = \Input::get('nombre');
        $c->email = \Input::get('email');
        $c->telefono = \Input::get('telefono');
        $c->mensaje = \Input::get('mensaje'); 
        $c->leido   = \Input::get('leido');      
        $c->save();
         return back()
         ->with('alert', 'Gracias por contactarnos, nos pondremos en contacto lo más pronto posible.');
    }

    public function redirect()
    {

        return view('sections.gracias');
    }

    public function bibliotecaMiembros(Request $request)
    {

        $hierachy = [
        'administrador' => 7,
        'secretario'    => 6,
        'tesorero'      => 5,
        'venerable'     => 4,
        'maestro'       => 3,
        'companero'     => 2,
        'aprendiz'      => 1

        ];


        $busqueda = $request->get('typeBusqueda');
        $busquedaTip = $request->get('busquedaTipeada');


        $typeRole = \Auth::user()->role;
        $libros [] = '';
        $role = $hierachy[$typeRole];

        if($busquedaTip != null )
        {

            $libros = $this->buscadorPorNombre($busquedaTip, $busqueda);
        }
        else
        {

            if ($busqueda == null or $busqueda == 0) {
                if ($role >= 3) {
                    $libros = \DB::table('libros')
                        ->where('grado', '<=', $role)
                        ->orderBy('autor', 'asc')
                        ->paginate(50);
                } elseif ($role <= 2) {

                    $libros = \DB::table('libros')
                        ->where('grado', '<=', $role)
                        ->orderBy('titulo', 'asc')
                        ->paginate(50);
                } elseif ($role == 1) {
                    $libros = \DB::table('libros')
                        ->where('grado', 1)
                        ->orderBy('autor', 'asc')
                        ->paginate(50);
                }
            }
            else
            {
                $libros = $this->buscadorPorGrado($role,$busqueda);

            }
        }



        return view('biblioteca.bibliotecaMiembros')
            ->with('libros',$libros);
    }

    public function buscadorPorGrado($role, $busqueda)
    {


        return \DB::table('libros')
            ->where("grado", $busqueda)
            ->where(function ($query) use ($role) {
                $query->where("grado", '<=', $role);

            })
            ->orderBy('autor', 'asc')
            ->paginate(50);


    }

    public function buscadorPorNombre($busqueda, $grado)
    {

        return Libro::getSearchMiembros($busqueda,$grado);

    }




}


