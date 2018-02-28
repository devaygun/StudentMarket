<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'date_of_birth' => 'required|date',
            'distance_unit' => 'required',
            'profile_picture' => 'image|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000',
            'password' => 'required|string|min:6|confirmed', // This also means that in the API request a "password_confirmation" input must be supplied
        ];
    }
}
