<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:15',
            'zip_code'     => 'required|string|max:9',
            'address'      => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'number'       => 'nullable|string|max:10',
            'complement'   => 'nullable|string|max:255',
            'city'         => 'required|string|max:255',
            'state'        => 'required|string|max:255',
        ];
    }
}
