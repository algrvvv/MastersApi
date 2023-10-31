<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('token:main');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $method = $this->method();

        if ($method == "PUT") {
            return [
                "fio" => ['required', 'unique:clients,fio'],
                "email" => ['required', 'email', 'unique:clients,email'],
                "phone" => ["required"],
                "birth_date" => ["required"],
                "id_childdata" => ['required']
            ];
        } else {
            return [
                "fio" => ['sometimes', 'required', 'unique:clients,fio'],
                "email" => ['sometimes', 'required', 'email', 'unique:clients,email'],
                "phone" => ['sometimes', "required"],
                "birth_date" => ['sometimes', "required"],
                "id_childdata" => ['sometimes', 'required']
            ];
        }
    }
}
