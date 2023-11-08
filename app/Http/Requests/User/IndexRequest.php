<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class IndexRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'foo' => 'required'
        ];
    }
    
}
