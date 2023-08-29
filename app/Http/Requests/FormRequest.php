<?php

namespace Illuminate\Foundation\Http;

use Illuminate\Validation\Rule;
use Illuminate\Http\Response as HTTP;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as CoreFormRequest;

class FormRequest extends CoreFormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    // /**
    //  * Get the validation rules that apply to the request.
    //  *
    //  * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
    //  */
    // public function rules(): array
    // {
    //     return [
    //         //
    //     ];
    // }

    // /**
    //  * Get the validation attributes that apply to the request.
    //  *
    //  * @return array
    //  */
    // public function attributes()
    // {
    //     return [
    //         //
    //     ];
    // }

    // /**
    //  * Get the validation messages that apply to the request.
    //  *
    //  * @return array
    //  */
    // public function messages()
    // {
    //     return [
    //         //
    //     ];
    // }


    /**
     * @throws \HttpResponseException When the validation rules is not valid
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(Response::json([
            'success'   => false,
            'status' => HTTP::HTTP_UNPROCESSABLE_ENTITY,
            'message'   => 'Validation failed.',
            'errors'     => $validator->errors(),
        ], HTTP::HTTP_UNPROCESSABLE_ENTITY)); // HTTP::HTTP_OK);
    }
}
