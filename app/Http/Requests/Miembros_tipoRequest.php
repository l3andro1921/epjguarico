<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Miembros_tipoRequest extends FormRequest
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
            'tipo_miembro' => 'required|min:4|unique:miembros_tipos'
        ];
    }
}
