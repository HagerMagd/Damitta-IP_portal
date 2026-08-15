<?php

namespace App\Http\Requests\dashboard\student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProfileRequest extends FormRequest
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
            'name'=>['string','min:10', 'max:50'],
            'password'=>['nullable','confirmed','min:8'],
            'image_path'=>['image',
            'nullable',
            'mimes:jpg,jpeg,png,webp',
            'max:2048',]

        ];
    }
}
