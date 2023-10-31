<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan("token:main");
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "fio" => ['required', 'unique:clients,fio'],
            "email" => ['required', 'email', 'unique:clients,email'],
            "phone" => ["required"],
            "birth_date" => ["required"],
            "id_childdata" => ['required']
        ];
    }
}