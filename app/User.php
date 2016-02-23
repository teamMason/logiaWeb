<?php

namespace portalLogia;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

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
    protected $fillable = ['name', 'email', 'password', 'type'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public function isAdmin()
    {
        return $this->id_type == '1';

    }
    public function isTesorero()
    {
        return $this->id_type == '2';

    }
    public function isSecretario()
    {
        return $this->id_type == '3';

    }
    public function isVenerable()
    {
        return $this->id_type == '4';

    }
    public function isMaestro()
    {
        return $this->id_type == '5';

    }
    public function isCompanero()
    {
        return $this->id_type == '6';

    }
    public function isAprendiz()
    {
        return $this->id_type == '7';

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

    public function getEmailAdmin()
    {

        return User::where('id_type', 1)->first();  
    }

}
