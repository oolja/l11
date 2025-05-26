<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user');
        $required = $this->method() === 'PATCH' ? 'filled' : 'required';

        return [
            'name' => [$required, 'string', 'max:255'],
            'email' => [
                $required,
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => [
                $required,
                'confirmed',
                Password::min(8)->mixedCase()->numbers(),
            ],
        ];
    }
}
