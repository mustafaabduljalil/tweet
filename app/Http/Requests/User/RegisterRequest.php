<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:users',
            'password' => 'required|string|max:191|min:6',
            'birth_date' => 'required|date|date_format:Y-m-d|before:today',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
