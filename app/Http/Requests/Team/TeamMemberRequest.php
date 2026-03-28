<?php
namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'image'    => 'nullable|file|mimes:jpg,jpeg,png,webp,svg|max:20480',
        ];
    }
}
