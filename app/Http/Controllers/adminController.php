<?php

namespace portalLogia\Http\Controllers;
use Illuminate\Http\Request;

use portalLogia\Http\Requests;
use Storage;

use portalLogia\Posts;
use portalLogia\Contacto;
use portalLogia\Libro;
use Input;


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

    public function biblioteca()
    {
        $libros = \DB::table('libros')->orderBy('autor','asc')->get();
        return view('administrador.libros.biblioteca')
            ->with('libros', $libros);

    }

    public function getExtension($fileName)
    {
        return substr($fileName,-4);
    }
    public  function uploadBook(Request $request)
    {
        $file = $request->file('file');
        $dir = public_path().'/uploads';

        foreach ( $file as $files)
        {
            $v = \Validator::make(['file' => $files], ['file' => 'mimes:pdf|max:10000']);
            if ($v->fails()) {

                return \Redirect::route('biblioteca')
                    ->with('alert-danger', 'Algunos de los Archivos que desea subir son demasiado pesados o no tienen un formato correcto.');
            }
            else
            {


                $libro = new Libro();
                $fileName = $files->getClientOriginalName();

                $ext = $this->getExtension($fileName);

                $slug = str_slug($fileName, "-");


                $libro->slug = substr($slug,0,-3).$ext;
                $libro->titulo = $fileName;
                $libro->grado = 0;
                $libro->autor = 'No especificado';
                $libro->editado = 'false';
                $files->move($dir, $fileName);

                $libro->save();

            }
        }
        return \Redirect::route('biblioteca')
            ->with('alert', 'Archivos Subidos exitosamente.');



    }



    public function deleteBook(){
        $id = \Input::get('borrarId');

        $librito = Libro::find($id);

        $dir = public_path().'/uploads'.'/';
        if(! is_null($librito) and  $librito->editado == 'true')
        {

            unlink($dir.$librito->slug);
            $librito->delete();
            return \Redirect::route('biblioteca')
                ->with('alert','El libro se ha Borrado Correctamente');
        }
        elseif($librito->editado == 'false')
        {
            unlink($dir.$librito->titulo);
            $librito->delete();
            return \Redirect::route('biblioteca')
                ->with('alert','El libro se ha Borrado Correctamente');

        }
        return \Redirect::route('biblioteca')
            ->with('alert','Ha ocurrido un error el libro no se encuentra');

    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function editBook(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required|max:100',
            'grado'  => 'required|numeric|between:1,3',
            'autor'  => 'max:100'
        ]);

        $librito = Libro::find($id);

        if ($librito->editado == 'false')
        {
            $oldName = $librito->titulo;
        }
        else
        {
            $oldName = $librito->slug;
        }


        $ext = $this->getExtension($librito->slug);

        //dd($ext);

        $librito->titulo = \Input::get('titulo');
        $librito->grado = \Input::get('grado');
        $librito->autor = \Input::get('autor');


        if(\Input::get('autor') == "")
        {
            $librito->autor = "No especificado";
        }
        $librito->editado = 'true';

        //$slug Cambia el formato del nombre con "-"
        $slug = str_slug( $librito->titulo, "-");
        $newName = $librito->slug = $slug.$ext;
        $librito->save();

        /*Change de the name file*/


        $this->changeNameFile($oldName,$newName);


        //$librito->descripcion = \Input::get('dscripcion');

        return \Redirect::route('biblioteca')
            ->with('alert','El libro se ha Modificado Correctamente');


    }
    public function changeNameFile($oldName,$newName)
    {
        $dir = public_path().'/uploads';
        $old = $dir.'/'.$oldName;
        $new = $dir.'/'.$newName;


        rename($old, $new);

    }



}
