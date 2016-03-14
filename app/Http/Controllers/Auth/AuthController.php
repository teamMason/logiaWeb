<?php

namespace portalLogia\Http\Controllers\Auth;

use portalLogia\Taller;
use portalLogia\User;

use portalLogia\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use Mail;
use portalLogia\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;




class AuthController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = "/admin";

    protected $loginPatch = "/auth/login";

    protected $redirectAfterLogout = "/";


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', [ 'except' => 'getLogout' ]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => 'required|max:255',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|confirmed|min:6',
            'id_taller' => 'required|unique:users',
            'ciudad'    => 'required',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     *
     * @return User
     */
    protected function create(array $data)
    {

        $user  = new User([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'ciudad'   => $data['ciudad'],

        ]);
        $user->id_taller = (int) $data['id_taller'];
        $role = $user->role = 'venerable';
        $user->token     = str_random(50);
        $user->ciudad    = \Input::get('ciudad');
        $user->prueba = 'PENDIENTE';
        $user->save();

        $taller = Taller::find($user->id_taller);
        $url = route('confirmacion', ['token' => $user->token]);

        if ($role == 'venerable') {
            $this->sendEmailtoAdmin($url,$user->name,$taller,$user->ciudad);
        } else {

        }

        return $user;
    }

    public function sendEmailtoAdmin($url, $nombre, $taller,$ciudad)
    {
        $admin = User::getEmailAdmin();
        $emailAdm = $admin->email;


        Mail::send('emails/registro', compact('emailAdm', 'nombre','url','taller','ciudad'), function ($m) use ($emailAdm)
        {
            $m->to($emailAdm)
                ->subject('Activación de cuenta para Venerable Maestro');
        });

    }




    public function loginPath()
    {
        return route('login');
    }


    public function redirectPath()
    {
        return route('adminSite');
    }


    protected function getFailedLoginMessage()
    {
        return trans('validation.Login');
    }
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());

        return redirect()->route('login')
            ->with('alert', 'Gracias Por registrarte una vez hayas sido aceptado por Gran logia se te hará
            llegar un mensaje via e-mail, esto puede tardar hasta 72hrs'.' '.$user->email);
    }

    protected function getCredentials($request)
    {
        return [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'token' => null
        ];
    }

}
