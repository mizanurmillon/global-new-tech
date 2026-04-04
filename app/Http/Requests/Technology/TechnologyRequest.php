<?php
namespace App\Http\Requests\Technology;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'icon'  => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:20480'],
        ];
    }
}
