<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\JsonAuthorizationException;
use App\Exceptions\JsonValidationException;
use \Illuminate\Contracts\Validation\Validator;

class IndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

     /**
     * Handle a failed authorization attempt.
     *
     * @return void
     *
     * @throws \Illuminate\Exceptions\JsonAuthorizationException
     */
    protected function failedAuthorization()
    {
        throw new JsonAuthorizationException;
    }

     /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new JsonValidationException($validator);
    }
    
}
