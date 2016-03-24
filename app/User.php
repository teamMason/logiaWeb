<?php

namespace portalLogia;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Mail;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function isAdmin()
    {
        return $this->role == 'administrador';

    }
    public function isTesorero()
    {
        return $this->role == 'tesorero';

    }
    public function isSecretario()
    {
        return $this->role == 'secretario';

    }
    public function isVenerable()
    {
        return $this->role == 'venerable';

    }
    public function isMaestro()
    {
        return $this->role == 'maestro';

    }
    public function isCompanero()
    {
        return $this->role == 'companero';

    }
    public function isAprendiz()
    {
        return $this->role == 'aprendiz';

    }



    public function stateSolicitud($id)
    {
        return Solicitud::where('id', $id)->where('estadoSolicitud', 'true')->count();

    }
    public function stateVotacion($id)
    {
        return Solicitud::where('id', $id)->where('estadoVotacion', 'true')->count();
        
      

    }
    public function stateIniciacion($id)
    {
        
        return Solicitud::where('id', $id)->where('estadoIniciacion', 'true')->count();

    }

    static public function getEmailAdmin()
    {

        return User::where('role','administrador')->first();
    }



}
