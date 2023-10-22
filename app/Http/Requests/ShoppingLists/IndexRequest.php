<?php

namespace App\Http\Requests\ShoppingLists;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'q' => ['sometimes', 'string', 'min:3', 'max:50'],
            'per_page' => ['sometimes', 'numeric', 'min:5', 'max:50']
        ];
    }
}
