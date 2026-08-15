<?php

namespace App\Http\Requests\dashboard\student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
        'desc' => ['required', 'string'],

        'main_research' => [
            'required',
            'file',
            'mimes:pdf,doc,docx',
            'max:10240',
        ],
        

        'registration_form' => [
            'required',
            'file',
            'mimes:pdf,doc,docx',
            'max:10240',
        ],

        'supporting_documents.*' => [
            'nullable',
            'file',
            'mimes:pdf,doc,docx,jpg,jpeg,png',
            'max:10240',
        ],

        'ethics_document' => [
            'nullable',
            'file',
            'mimes:pdf,doc,docx',
            'max:10240',
        ],
    
        ];
    }
}
