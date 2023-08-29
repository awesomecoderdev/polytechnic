<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "technology_id" => "required",
            "collage_id" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required",
            "password" => "required",
            "phone" => "required",
            "image" => "required",
            "gender" => "required",
            "semester" => "required",
            "roll" => "required",
            "reg" => "required",
            "shift" => "required",
            "session" => "required",
            "dob" => "required",
        ];
    }
}
