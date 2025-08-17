<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

final class StoreCategoryRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'restaurantId' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $snakeCased = collect($this->all())
            ->mapWithKeys(fn ($value, $key) => [Str::snake($key) => $value])
            ->toArray();

        $this->merge($snakeCased);
    }
}
