<?php

namespace portalLogia\Http\Requests;

use portalLogia\Http\Requests\Request;
use Illuminate\Routing\Route;


class ActualizaMiembrosAdmRequest extends Request
{

    public function __construct(Route $route)
    {
        $this->route = $route;

    }


    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        return [
            'email'       => 'required|unique:miembros,email,'.$this->route->getParameter('id'),
            'nombre'      => 'required|min:2|max:150|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido'    => 'required|min:2|max:150|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'cargo'       => 'required_if:grado,MAESTRO',
            'grado'       => 'required',
            'mlibre'      => 'required|max:2',
            'voto'        => 'required',
            'taller'      => 'Integer|required',
            'telefono'    => 'regex:/^([0-9_-])+((-*)+([0-9_-]*)*)+$/',
            'telefonoCel' => 'regex:/^([0-9_-])+((-*)+([0-9_-]*)*)+$/',


        ];
    }
}
