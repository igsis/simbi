<?php

namespace Simbi\Http\Requests\SecaoBraile;

use Illuminate\Foundation\Http\FormRequest;

class ValidateStore extends FormRequest
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
           'equipamento_id' => 'required',  
           'periodo' => 'required',
           'data'    =>  'required',
           'quantidade' =>  'required|integer|between: 0, 9999'       
        ];        
    }
}
