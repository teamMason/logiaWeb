<?php

namespace portalLogia\Http\Requests;

use portalLogia\Http\Requests\Request;

class RegistraMiembrosAdmRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'email'       => 'required|unique:miembros,email',
            'nombre'      => 'required|min:2|max:150|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'apellido'    => 'required|min:2|max:150|regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/',
            'grado'       => 'required',
            'taller'      => 'Integer|required',
            'telefono'    => 'regex:/^([0-9_-])+((-*)+([0-9_-]*)*)+$/',
            'telefonoCel' => 'regex:/^([0-9_-])+((-*)+([0-9_-]*)*)+$/',
            'estado'      => 'required'



        ];
    }
}

/* 
AlphaNum|  verifica que sean solo numeros y letras
alpha_dash  Alpha numerico más _,-
between:min,max valores entre a y b 


*/