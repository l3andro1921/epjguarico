<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiaRequest extends FormRequest
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
            'titulo'        => 'required|min:10|max:50',
            'lugar'         => 'required|min:10|max:50',
            'fecha'         => 'required',
            'resumen'       => 'required|min:10|max:220',
            'descripcion'   => 'required',
            'imagen'          => 'required|image'
        ];
    }
}
