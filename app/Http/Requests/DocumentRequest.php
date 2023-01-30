<?php

namespace App\Http\Requests;

use App\Rules\Base64ImageValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
                    'title'    => 'required|string',
                    'content' => 'required|mimes:pdf,doc,docx,jpeg,jpg,png',
                    'signin64' => ['required_without:signin', 'nullable'],
                    'signin'   => 'nullable|mimes:pdf,jpeg,jpg,png'
                ];
                break;
            case 'PATCH':
                return [
                    'title'   => 'required|string',
                    'content' => 'nullable|mimes:pdf,doc,docx,jpeg,jpg,png',
                ];
                break;
            default:
                break;
        }
    }
}
