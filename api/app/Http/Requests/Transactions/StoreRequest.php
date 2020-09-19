<?php

namespace App\Http\Requests\Transactions;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from' => 'required|integer|exists:accounts,id|different:to',
            'to' => 'required|integer|exists:accounts,id|different:from',
            'details' => 'required|string|max:250',
            'amount' => 'required|numeric|gt:0|between:1,1000000' // for security reasons max transferable amount is between 1 and 1,000,000 usd
        ];
    }
}