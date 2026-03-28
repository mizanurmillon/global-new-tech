<?php
namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'name'        => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'website_url' => 'required|url|max:255',
            'is_active'   => 'nullable|boolean',
        ];

        if ($this->isMethod('POST')) {
            $rules['logo'] = 'required|max:20480';
        } elseif ($this->isMethod('PUT')) {
            $rules['logo'] = 'nullable|max:20480';
        }

        return $rules;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active'),
        ]);
    }
}
