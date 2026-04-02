<?php

namespace App\Http\Requests\SecurityAssessment;

use Illuminate\Foundation\Http\FormRequest;

class SecurityAssessmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:security_assessments,email',
            'phone_number' => 'required|string|max:20',
            'company_name' => 'required|string|max:255',
            'security_interest' => 'required|string|max:255',
            'company_size' => 'nullable|string|max:100',
            'timeline' => 'nullable|string|max:100',
            'budget_range' => 'nullable|string|max:100',
            'message' => 'nullable|string',
            'status' => 'nullable|in:pending,in_progress,completed',

        ];
    }
}
