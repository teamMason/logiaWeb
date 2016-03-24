<?php

namespace portalLogia\Http\Controllers;
use portalLogia\Http\Requests;
use Illuminate\Http\Request;
use Carbon\Carbon;
use User;
use portalLogia\Recibos;



use portalLogia\Http\Requests\RegistraMiembrosVenRequest;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Taller;
use portalLogia\Solicitud;
use portalLogia\Votacion;
use portalLogia\Miembros;
use Illuminate\Contracts\Auth\Guard;
use Input;
use Mail;

class venerableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function registrarSolicitud()
   {
      $user = \Auth::user()->id_taller;
      $s = \DB::table('users')
            ->select('taller.nombreTaller',
                     'users.id_taller',
                     'users.ciudad'
            )
            ->join('taller', 'taller.id','=','users.id_taller')
            ->where('taller.id',$user)
            ->get();
            return view('venerable.registrarSolicitud')
            ->with('taller', $s);
  }

   public function enviarSolicitud(RegistraMiembrosVenRequest $request)
   {


      $date = Carbon::now();
      $date = $date->addDay(15);
      $date = $date->format('d-m-Y');
      $file = $request->file('file');
      $dir = public_path().'/fotos_solicitud';
      $fileName = $file->getClientOriginalName();
      $file->move($dir, $fileName);

      $t = new Solicitud;
        $t->nombre = \Input::get('nombre');
        $t->apellido = \Input::get('apellido');
        $t->id_taller = \Input::get('id_taller');
        $t->ciudad = \Input::get('ciudad');
        $t->profesion = \Input::get('profesion');
        $t->path = $fileName;
        $t->edoCivil = \Input::get('edoCivil');
        $t->ingresoMen = \Input::get('ingresoMen');
        $t->telefono = \Input::get('telefono');
        $t->telefonoCel = \Input::get('telefonoCel');
        $t->comentarios = \Input::get('comentarios',150);
        $t->estadoSolicitud = 'false';
        $t->estadoVotacion = 'false';
        $t->estadoIniciacion = 'false';
        $t->estadoAlta = 'false';
        $t->email = \Input::get('email');
        $t->fechaLim = $date;
        $t->save();

       $nameTaller = Taller::find($t->id_taller);
       $this->sendEmailAdmSolicitud($t->id,$nameTaller);

        return \Redirect::route('registrarSolicitud')
       ->with('alert', 'La Solicitus ha sido enviada con éxito!, Recuerda pasar a dejar tú voto!')->withInput();

   }

    public function sendEmailAdmSolicitud($id_sol, $nameTaller)
    {
        $sol = Solicitud::find($id_sol);
        $nombre = $sol->nombre.' '.$sol->apellido;
        $email = \Auth::user()->getEmailAdmin();
        $admEmail = array($email->email);

        Mail::send('emails.sendEmailSolicitudMiembro',compact('nombre','nameTaller') , function($msj) use ($admEmail){
            $msj->subject('Solicitud de iniciación');
            $msj->to($admEmail, 'para');
        });

    }

    public function verProspectos()
    {
       //$solicitudes = \DB::table('solicitudes')->where('estadoSolicitud', 'visible')->orderBy('id','desc')->get();


        $votaciones = Votacion::all();
        $s = \DB::table('solicitudes')
            ->select('solicitudes.*',
                     'taller.nombreTaller'
            )
            ->join('taller', 'taller.id','=','solicitudes.id_taller')
            ->where('estadoSolicitud','true')
            ->where('solicitudes.estadoVotacion', '=', 'false')
            ->get();

            return view('venerable.votacionesMiembros')
            ->with('solicitudes',$s)->with('votacion',$votaciones);




    }

    public function enviarVotacion($id_sol, $id_taller)
    {

      $votandoPor = Solicitud::find($id_sol);
      $check = unserialize($votandoPor->check);



      if($check[$id_taller] == "false")
      {

        $check[$id_taller] =  "true";
        $votandoPor->check = serialize($check);
        $votandoPor->save();

        $votacion = new Votacion;
        $votacion->comentarios = \Input::get('comentarios');
        $votacion->estatus = \Input::get('voto');
        $votacion->id_taller = $id_taller;
        $votacion->id_solicitud = $id_sol;
        $votacion->save();

        return \Redirect::route('votaciones')
        ->with('alert','Tu Voto ha sido registrado, Gracias!');

      }
      else
      {

        return \Redirect::route('votaciones')
       ->with('alert','Ya has votado anteriormente, Gracias!');
      }

    }

    public function estatusIniciacion(){
      $taller = \Auth::user()->id_taller;

      $s = Solicitud::where('id_taller', $taller)
      ->where('estadoIniciacion','false')->get();

      return view('venerable.misIniciaciones')
        ->with('alert', 'Una vez hayas llevado a cabo tu iniciación por favor conforma presionando el botón realizado!')
        ->with('iniciaciones', $s);

    }


    public function finDeIniciacion($id)
    {

        $id_taller = \Auth::user()->id_taller;
        $nameTaller = Taller::find($id_taller);

        $m = Solicitud::find($id);
        if ($m->estadoVotacion == 'true') {
            $m->estadoIniciacion = 'true';
            $this->sendEmailAdm($id, $nameTaller->nombreTaller);
            $m->save();

            return \Redirect::route('iniciaciones')->with('alert',
                'Éxito, una vez sea dado de alta se te confirmará vía E-mail.!!');
        } else {
            return \Redirect::route('iniciaciones')->with('alert', 'Aun no has pasado el proceso de Votación');
        }


    }

    public function sendEmailAdm($id_sol, $nameTaller)
    {

      $sol = Solicitud::find($id_sol);
      $nombre = $sol->nombre.' '.$sol->apellido;
      $email = \Auth::user()->getEmailAdmin();
      $admEmail = array($email->email);

        Mail::send('emails.sendEmailconfirmationadm',compact('nombre','nameTaller') , function($msj) use ($admEmail){
          $msj->subject('Aprobación de Iniciación');
          $msj->to($admEmail, 'para');
        });

    }


    public function consultaMiembrosTaller()
    {


        $typeBusqueda = Input::get('typeBusqueda');

        $miembros = '';
        $taller = \Auth::user()->id_taller;

        if(! is_null($typeBusqueda))
        {


            $miembros = \DB::table('miembros')
                ->select('miembros.*',
                    'taller.nombreTaller'
                )
                ->join('taller', 'taller.id','=','miembros.id_taller' )
                ->where(function ($query) use ($typeBusqueda, $taller)
                {
                    $query->where('taller.id', $taller);
                })->
                where(function ($query) use ($typeBusqueda, $taller)
                {
                    $query->orWhere('nombre', 'LIKE', "%$typeBusqueda%")
                        ->orWhere('apellido', 'LIKE', "%$typeBusqueda%");
                })
                ->orderBy('taller.id')
                ->paginate(25);

        }
        else
        {

            $miembros = \DB::table('miembros')
            ->select('miembros.*',
                'taller.nombreTaller'
            )
            ->join('taller', 'taller.id','=','miembros.id_taller' )
            ->where('id_taller',$taller)
            ->orderBy('taller.id')
            ->paginate(25);

        }
        return view('venerable.consultaMiembrosTaller')
            ->with('miembros',$miembros);



    }

    public function actualizaMiembros(Request $request, $id)
    {
       $this->validate($request, [
            'email' => 'email',

        ]);

        $miembro = Miembros::find($id);
        $miembro->email = Input::get('emal');
        $miembro->telefono = Input::get('telefono');
        $miembro->telefonoCel = Input::get('telefonoCel');
        $miembro->estado = Input::get('estado');
        $miembro->save();

        return \Redirect::route('consultaMTaller')
        ->with('alert', 'Actualización correcta!');


    }

    public function aumentosSalario($id_taller, $id_miembro)
    {

        $miembro = Miembros::where('id',$id_miembro)->first();

        if($miembro->grado == 'APRENDIZ')
        {
            $miembro->grado = 'COMPANERO';
            Recibos::hacerCobroAunmentoComp($id_taller);
        }
        elseif($miembro->grado == 'COMPANERO')
        {
            $miembro->grado = 'MAESTRO';
            Recibos::hacerCobroAunmentoMM($id_taller);
        }
        $miembro->save();
        return \Redirect::route('consultaMTaller')
            ->with('alert', 'Completado exitosamente ');


    }

    public function bajaMiembro($id){

        $miembro = Miembros::find($id);
        $miembro->estado = 'BAJA';
        $miembro->save();
        return \Redirect::route('consultaMTaller')
            ->with('alert', 'Se ha dado de baja a '.$miembro->nomre.' '.$miembro->apllido.' '.'exitosamente');

    }
    public function altaMiembro($id){

        $miembro = Miembros::find($id);
        $miembro->estado = 'ACTIVO';
        $miembro->save();

        $id_taller = \Auth::user()->id_taller;
        Recibos::altaMiembroPago($id_taller);

        return \Redirect::route('consultaMTaller')
            ->with('alert', 'Se ha dado de Alta a '.$miembro->nomre.' '.$miembro->apllido.' '.'exitosamente, esto generará un costo.');

    }





}
