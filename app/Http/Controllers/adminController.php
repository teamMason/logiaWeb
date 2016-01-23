<?php

namespace portalLogia\Http\Controllers;

use Illuminate\Http\Request;
use portalLogia\Http\Requests;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Posts;
use portalLogia\Contacto;


class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

          
    }
    public function admin()
    {
        
        return view('administrador.blogAdmin.admin');
        
    }

/*ADMINISTRACIÓN DEL BLOG*/
      public function blog()
    {
        $posts = \DB::table('posts')->orderBy('id','desc')->paginate(7);
        return view('administrador.blogAdmin.adminBlog')
        ->with('posts',$posts);
    }
    public function edit($id)
    {
       $posts = Posts::find($id);
       return view('administrador.blogAdmin.editArticle')
       ->with('posts', $posts); 

    }

    public function refresh($id)
    {
        $p = Posts::find($id);
        $p->title = \Input::get('title');
        $p->content = \Input::get('content');
        $p->tags = \Input::get('tags');
        $p->photo = \Input::get('photo');
        $p->autor = \Input::get('autor');
        $p->estatus = \Input::get('estatus');
              
 
        $p->resluggify();
        $p->save();
        return \Redirect::route('adminBlog');
        

    }
    public function nuevoArticulo()
    {
        return view('administrador.blogAdmin.nuevoArticulo');
    }

    public function crearArticulo()
    {
        

        $p =  new Posts;
        $p->title = \Input::get('title');
        $p->content = \Input::get('content');
        $p->tags = \Input::get('tags');
        $p->photo = \Input::get('photo');
        $p->autor = \Input::get('autor');
        $p->estatus = \Input::get('estatus');
        $p->save();
              
 
        
      
        return \Redirect::route('adminBlog')
        ->with('alert', 'Tu publicación ha sido creada con éxito!');
      
    }

    public function borrarArticulo()
    {
          $p = new Posts;
          $p->id = \Input::get('borrarId');
          $post = Posts::find( $p->id);
          $post ->delete();  
          return \Redirect::route('adminBlog');
    }


    //Contacto


    public function verBuzon()
    {

      
      $buzon = \DB::table('contacto')->orderBy('id','desc')->paginate(15);
      return view('administrador.contacto.contacto')
      ->with('buzon',$buzon);


    }

    public function leido($id)
    {
      $c = Contacto::find($id);
      $c->leido = 'leido';
      $c->save();
      return \Redirect::route('buzon');
    }

    public function borrarMensaje()
    {
        $m = new Contacto();
        $m->id = \Input::get('borrarId');

        $buzon = Contacto::find($m->id);

        $buzon->delete();
        return \Redirect::route('buzon');



    }

}
