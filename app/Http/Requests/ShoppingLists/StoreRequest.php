<?php

namespace App\Http\Requests\ShoppingLists;

use App\Models\Shop;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'shop' => [
                'required',
                'numeric',
                Rule::exists((new Shop())->getTable(), 'id')
            ]
        ];
    }

    protected function passedValidation(): void
    {
        $shop = Shop::find($this->input('shop'));
        $this->route()->setParameter('shop', $shop);
    }
}
