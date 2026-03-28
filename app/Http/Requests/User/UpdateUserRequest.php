<?php
namespace App\Http\Requests\User;

use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'nullable|string|max:50',
            'phone'       => 'nullable|string|max:30',
            'avatar_path' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:20480', // 20MB
        ];
    }
}
