<?php

namespace App\Http\Requests\Group;

use App\Http\Requests\FailedValidationThrowException;
use Illuminate\Foundation\Http\FormRequest;

class CreateGroupRequest extends FormRequest
{
    use FailedValidationThrowException;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'expire_hours' => 'required|integer|min:1',
        ];
    }
}
