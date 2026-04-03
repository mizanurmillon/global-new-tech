<?php
namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:255',

            'email'       => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->route('team')?->id),
            ],

            'password'    => $this->isMethod('post') ? 'required|string|min:8' : 'nullable|string|min:8',

            'position'    => 'nullable|string|max:255',
            'avatar_path' => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:20480',
        ];
    }
}
