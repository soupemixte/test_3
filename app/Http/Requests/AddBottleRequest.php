<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddBottleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'bottle_id' => 'required|exists:bottles,id',
            'cellar_id' => 'required|exists:cellars,id',
            'quantity' => 'required|integer|min:1'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'bottle_id.required' => 'La bouteille est requise.',
            'bottle_id.exists' => 'La bouteille sélectionnée n\'existe pas.',
            'cellar_id.required' => 'Le cellier est requis.',
            'cellar_id.exists' => 'Le cellier sélectionné n\'existe pas.',
            'quantity.required' => 'La quantité est requise.',
            'quantity.integer' => 'La quantité doit être un nombre entier.',
            'quantity.min' => 'La quantité minimale est de 1.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'bottle_id' => $this->route('id'),
        ]);
    }
}