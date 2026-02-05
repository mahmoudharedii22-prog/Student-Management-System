<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreDeletedStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required',
                Rule::exists('users', 'id')->whereNotNull('deleted_at')],
        ];
    }
}
