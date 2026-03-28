<?php
namespace App\Http\Requests\Testimonial;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'          => ['required', 'string', 'max:255'],
            'text'           => ['required', 'string'],
            'summary'        => ['required', 'string', 'max:250'],
            'project_id'     => ['required', 'exists:projects,id'],
            'team_member_id' => ['required', 'exists:team_members,id'],
            'is_active'      => ['nullable', 'boolean'],
        ];
    }
}
