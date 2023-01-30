<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':
                return [
                    'name'     => 'required|string',
                    'email'    => 'required|email|unique:users,email',
                    'password' => 'required|confirmed|min:6',
                    'phone'    => 'required|numeric|digits_between:10,13'
                ];
                break;
            case 'PATCH':
                return [
                    'company'  => 'nullable|string',
                    'division' => 'nullable|string',
                    'picture'  => 'nullable|mimes:png,jpg'
                ];
                break;
            default:
                break;
        }
    }
}
