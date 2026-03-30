<?php
namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'             => 'required|string|max:255',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png,webp,gif',
            'short_description' => 'required|string',
            'long_description'  => 'nullable|string',
        ];
    }
}
