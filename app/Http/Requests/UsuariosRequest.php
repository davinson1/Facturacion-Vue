<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
          'idTipoDocumento'     => 'required',
          'idMunicipio'         => 'required',
          'nombre'    => 'required|min:3|max:100',
          'apellido'  => 'required|min:3|max:100',
          'documento' => 'required|unique:users,numero_documento|numeric|min:100000|max:9999999999',
          'email'     => 'required|unique:users,email',
          'foto'       => 'image|nullable',
          'copiaDocumento'    => 'nullable',
          'contrasena'     => 'required|min:8|string',
          'rol'           => 'required'

        ];

    }

    public function messages()
{
    return [
        'documento.max' => 'EL campo debe contener entre 6 a 10 números',

    ];
  }
}
