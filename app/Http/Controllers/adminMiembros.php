<?php

namespace portalLogia\Http\Controllers;

<<<<<<< HEAD
=======
use Illuminate\Support\Facades\Redirect;
>>>>>>> 9a8b8cb04948f94002a1fa5ee34663740333cd59
use portalLogia\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use portalLogia\Http\Requests\RegistraMiembrosAdmRequest;
use portalLogia\Http\Requests\ActualizaMiembrosAdmRequest;
use portalLogia\Http\Controllers\Controller;
use portalLogia\Miembros;
use portalLogia\Recibos;
use portalLogia\Solicitud;
use portalLogia\Taller;
use portalLogia\User;
use Mail;
use portalLogia\Votacion;

class adminMiembros extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*ADMINISTRACIÓN DE MIEMBROS*/

    /*Muestra las Solicitudes antes de enviar a votación*/
    public function aprobarMiembros()
    {

        // $s2 = Solicitudes::all()->where('estadoSolicitud', 'ocultoVen');
        $s = \DB::table('solicitudes')->select('solicitudes.id', 'solicitudes.nombre', 'solicitudes.path',
            'solicitudes.apellido', 'solicitudes.ciudad', 'solicitudes.profesion', 'solicitudes.edoCivil',
            'solicitudes.fechaLim', 'solicitudes.ingresoMen', 'solicitudes.ingresoMen', 'solicitudes.telefono',
            'solicitudes.telefonoCel', 'solicitudes.comentarios', 'taller.nombreTaller')->join('taller', 'taller.id',
            '=', 'solicitudes.id_taller')->where('solicitudes.estadoSolicitud', '=', 'false')->get();

        return view('administrador.miembros.solicitudesMiembros')->with('solicitudes', $s);

    }


    /*Cambia los estados de votacion y visibilidad*/
    public function enviarAVotacion($id)
    {
        #crea el Check de Votación
        $numTalleres = \DB::table('taller')->count();
        $check       = [ ];
        for ($i = 1; $i <= $numTalleres; $i++) {
            $check[] = 'false';
        }
        $check = serialize($check);

        $solicitud                  = Solicitud::find($id);
        $solicitud->check           = $check;
        $solicitud->estadoSolicitud = 'true'; #hace visible la votación para venerables
        $solicitud->save();
        $this->sendEmailtoVenInitVotacion($solicitud, $solicitud->id_taller);

        return \Redirect::route('aprobaciones')->with('alert',
            'La solicitud ha sido enviado a votación!'); ///////////////////////

    }


    public function sendEmailtoVenInitVotacion($user, $id_taller)
    {

        $nvenerable = User::where('id_taller', $id_taller)->first();
        $email      = $nvenerable->email;

        $taller = Taller::where('id', $id_taller)->get();

        Mail::send('emails/enviadoToVotacion', compact('user', 'taller'), function ($m) use ($email) {
            $m->to($email)->subject('Solicitud enviada a votación!');
        });

    }


    public function borrarSolicitud()
    {
        $p         = new Solicitud;
        $p->id     = \Input::get('borrarId');
        $solicitud = Solicitud::find($p->id);
        $solicitud->delete();

        return \Redirect::route('aprobaciones')->with('alert', 'La solicitud ha sido borrada!');

    }


    public function borrarVotacion()
    {
        $p         = new Solicitud;
        $p->id     = \Input::get('borrarId');
        $solicitud = Solicitud::find($p->id);
        $solicitud->delete();
        $voto = votacion::where('id_solicitud', $p->id);
        $voto->delete();

        return \Redirect::route('votaNeofitos')->with('alert',
            'Ingreso Cancelado, se notificará al taller correspondiente!');
    }


    public function verVotaciones()
    {
        //$solicitudes = \DB::table('solicitudes')->where('estadoVotacion', 'votando')->orderBy('id','desc')->get();

        $s = \DB::table('solicitudes')->select('solicitudes.id', 'solicitudes.nombre', 'solicitudes.apellido',
            'solicitudes.ciudad', 'solicitudes.id_taller', 'solicitudes.fechaLim',
            'taller.nombreTaller')->join('taller', 'taller.id', '=',
            'solicitudes.id_taller')->where('solicitudes.estadoAlta', 'false')->where('solicitudes.estadoSolicitud',
            'true')->get();

        return view('administrador.miembros.votaNeofitos')->with('solicitudes', $s);


    }


    public function aprobarIniciacion($id)
    {

        $s                 = Solicitud::find($id);
        $s->estadoVotacion = 'true';
        $id_taller         = $s->id_taller;
        $s->save();

        $this->sendEmailVen($id_taller, $id);

        return \Redirect::route('votaNeofitos')->with('alert',
            'Listo, se ha enviado un correo de confirmacion al taller corespondiente!');

    }


    /*$id_sol es el id de solicitud*/
    public function sendEmailVen($id_taller, $id_solicitud)
    {

        $ven         = \DB::table('users')->select('email')->where('id_taller', $id_taller)->first();
        $venEmail    = [ $ven->email ];
        $solicitante = Solicitud::find($id_solicitud);
        $nombre      = $solicitante->nombre;

        Mail::send('emails.sendIniciacion', [ 'nombre' => $nombre ], function ($msj) use ($venEmail) {
            $msj->subject('Aprobación de Iniciación');
            $msj->to($venEmail, 'para');
        });


    }


    public function miembroAceptado($id_sol, $id_taller)
    {

        $s = Solicitud::find($id_sol);
        $m = new Miembros;

        //ya ha sido votado, la votación se oculta
        $s->estadoAlta = 'true';

        $m->nombre      = $s->nombre;
        $m->apellido    = $s->apellido;
        $m->grado       = 'aprendiz';
        $m->mlibre      = 'no';
        $m->voto        = 'no miembro';
        $m->telefono    = $s->telefono;
        $m->telefonoCel = $s->telefonoCel;
        $m->telefonoCel = $s->email;
        $m->id_taller   = $s->id_taller;

        $nombreCompleto = $s->nombre . ' ' . $s->apellido;
        $this->sendEmailVenAlta($s->id_taller, $nombreCompleto);
        //Suma una iniciacion por id_taller a la tabla recibo
        $m->save();
        $s->save();

        Recibos::hacerCobroIniciacion($id_taller);

        return \Redirect::route('votaNeofitos')->with('alert',
            'El solicitante ha sido aceptado y registrado en el padrón de su taller!');

    }


    public function sendEmailVenAlta($id_taller, $nombreCompleto)
    {

        $ven      = \DB::table('users')->select('email')->where('id_taller', $id_taller)->first();
        $venEmail = [ $ven->email ];

        Mail::send('emails.sendAltaven', [ 'nombre' => $nombreCompleto ], function ($msj) use ($venEmail) {
            $msj->subject('Proceso Terminado');
            $msj->to($venEmail, 'para');

        });


    }


    public function verVotosMiembro($id)
    {

        $votos = \DB::table('votaciones')->select('votaciones.comentarios', 'votaciones.estatus',
            'taller.nombreTaller')->join('taller', 'taller.id', '=',
            'votaciones.id_taller')->where('votaciones.id_solicitud', $id)->get();

        $solicitante = Solicitud::find($id);

        ///dd($estatus);
        return view('administrador.miembros.votosPorlogia')->with('votos', $votos)->with('solicitante', $solicitante);


    }


    /*  CONSULTA Y EDICIÓN DE DE MIEMBROS*/

    /* Formulario para registro directo de miembros*/
    public function registrarMiembros()
    {

        $talleres = \DB::table('taller')->orderBy('id', 'asc')->get();

        return view('administrador.miembros.registraMiembros')->with('talleres', $talleres);
    }


    /*Envia la info del nuevo miembro para ser registrada*/

    public function enviarRegistro(RegistraMiembrosAdmRequest $request)
    {
        $t           = Miembros::Create($request->all());
        $t->nombre   = \Input::get('nombre');
        $t->apellido = \Input::get('apellido');
        $id_taller   = $t->id_taller = \Input::get('taller');
        $grado       = $t->grado = \Input::get('grado');

        if ($grado == 'PAST MASTER') {
            $t->voto = 'PERMANENTE';
        } else {
            $t->voto = 'NO MIEMBRO';
        }
        $t->email       = \Input::get('email');
        $t->telefono    = \Input::get('telefono');
        $t->telefonoCel = \Input::get('telefonoCel');
        $t->cargo       = 'SIN CARGO';
        $t->mlibre      = 'NO';
        $t->estado      = \Input::get('estado');
        $t->save();

        //return \Redirect::route('registrarMiembros')
        return redirect()->back()->with('alert', 'El nuevo miembro ha sido registrado con éxito en su padrón!');

    }


    public function actualizaMiembros(ActualizaMiembrosAdmRequest $request, $id)
    {
        $t = Miembros::findOrFail($id);

        $t->nombre = $request->input('nombre');;
        $t->apellido = $request->input('apellido');;
        $t->id_taller = \Input::get('taller');
        $t->grado     = $request->input('grado');
        $t->cargo     = $request->input('cargo');
        $t->email     = $request->input('email');
        $t->mlibre    = $request->input('mlibre');
        $t->voto      = $request->input('voto');

        $t->telefono    = $request->input('telefono');
        $t->telefonoCel = $request->input('telefonoCel');
        $t->save();

        return \Redirect::route('consulta')->with('alert', 'Actualización correcta!');
    }


    public function consultaMiembros(Request $request)
    {

        $subBusqueda  = $request->get('subBusqueda');
        $typeBusqueda = $request->get('typeBusqueda');
        $miembros     = '';

        if ($typeBusqueda == null and $subBusqueda == 0) {

            $miembros = \DB::table('miembros')->select('miembros.*', 'taller.nombreTaller')->join('taller', 'taller.id',
                '=', 'miembros.id_taller')->orderBy('taller.id')->paginate(25);

        } else {
            if ( ! is_null($typeBusqueda) and $subBusqueda == 0) {
                //dd('HOLA');
                $miembros = \DB::table('miembros')->select('miembros.*', 'taller.nombreTaller')->join('taller',
                    'taller.id', '=', 'miembros.id_taller')->where('cargo', 'LIKE', "%$typeBusqueda%")->orWhere('grado',
                    'LIKE', "%$typeBusqueda%")->orWhere('mlibre', 'LIKE', "%$typeBusqueda%")->orWhere('voto', 'LIKE',
                    "%$typeBusqueda%")->orWhere('estado', 'LIKE', "%$typeBusqueda%")->orWhere('id_taller', 'LIKE',
                    "%$typeBusqueda%")->orderBy('taller.id')->paginate(25);

            } else {
                if ( ! is_null($typeBusqueda) and $subBusqueda != 0) {

                    $miembros = \DB::table('miembros')->select('miembros.*', 'taller.nombreTaller')->join('taller',
                        'taller.id', '=', 'miembros.id_taller')->where(function ($query) use (
                        $typeBusqueda,
                        $subBusqueda
                    ) {
                        $query->where('taller.id', $subBusqueda);

                    })->where(function ($query) use ($typeBusqueda, $subBusqueda) {
                        $query->orWhere('cargo', 'LIKE', "%$typeBusqueda%")->orWhere('grado', 'LIKE',
                            "%$typeBusqueda%")->orWhere('mlibre', 'LIKE', "%$typeBusqueda%")->orWhere('voto', 'LIKE',
                            "%$typeBusqueda%")->orWhere('estado', 'LIKE', "%$typeBusqueda%")->orWhere('id_taller',
                            'LIKE', "%$typeBusqueda%");
                    })->orderBy('taller.id')->paginate(25);

                }
            }
        }
        $telleres = Taller::all();

        return view('administrador.miembros.consultaMiembros')->with('miembros', $miembros)->with('talleres',
            $telleres);
    }


    public function aprobarVen(Request $request)
    {

        $busqueda   = $request->get('busqueda');
        $venerables = '';

        if ($busqueda == null) {

            $venerables = \DB::table('users')->select('name', 'users.id', 'taller.nombreTaller', 'users.created_at',
                'users.token')->join('taller', 'taller.id', '=', 'users.id_taller')->where('users.estado',
                    'PENDIENTE')->orWhere('users.estado',
                    'ACTIVO')->orderBy('taller.id')->paginate(40);

        } else {
            $venerables = \DB::table('users')->select('name', 'users.id', 'taller.nombreTaller', 'users.created_at',
                'users.token')->join('taller', 'taller.id', '=', 'users.id_taller')->where(function ($query) use (
                    $busqueda
                ) {
                    $query->where('name', 'LIKE', "%$busqueda%");
                })->where('token', null)->orderBy('taller.id')->paginate(40);


        }

        return view('administrador.venerables.confirmacionVenerables')->with('venerables', $venerables);

    }


    protected function getConfirmacion($token)
    {
        $user        = User::where('token', $token)->firstOrFail();
        $email       = $user->email;
        $user->token = null;
        $user->save();

        Mail::send('emails/altaVenerables', compact('user'), function ($m) use ($email) {
            $m->to($email)->subject('Su cuenta ha sido activada!');
        });

        return \Redirect::route('confirmVen')->with('alert',
                'Cuenta activada satisfactoriamente, se avisará via Email.');
    }


    public function borrarRegistro($id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->estado = 'BAJA';

        if($user->role == 'tesorero' or $user->role == 'secretario')
        {
            return \Redirect::route('registraAdministrativa')->with('alert', 'Sa ha borrado el registro exitosamente');
        }

        return \Redirect::route('confirmVen')->with('alert', 'Sa ha borrado el registro exitosamente');
    }


    public function rechazarRegistro($id)
    {
        $user         = User::where('id', $id)->firstOrFail();
        $user->token  = null;
        $user->estado = 'RECHAZADO';
        $user->save();

        return \Redirect::route('confirmVen')->with('alert', 'Solicitud Rechazada');
    }


    public function registroAdministrativos(Request $request)
    {

        $administrativos = User::where('id_taller', '<', -1)->get();

        return view('administrador.altaAdministrativos.altaAdministrativos')
            ->with('administrativos', $administrativos);
    }


    public function altaAdministrativos(Request $request)
    {

        $this->validate($request, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'ciudad'   => 'required',
            'role'     => 'required|unique:users',

        ]);

        $user           = new User();
        $user->name     = \Input::get('name');
        $user->email    = \Input::get('email');
        $user->role     = \Input::get('role');
        $user->ciudad   = \Input::get('ciudad');
        $pass           = \Input::get('password');
        $user->password = bcrypt($pass);

        if ($user->role == 'secretario') {
            $user->id_taller = -2;
        } else {
            $user->id_taller = -3;
        }

        $user->save();
        return \Redirect::route('registraAdministrativa')
            ->with('alerts','Se ha registrado Exitosamente');
    }

}
