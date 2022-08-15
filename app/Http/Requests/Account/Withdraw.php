<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Withdraw extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                
                // Calculating maximum withdraw amount based on balance.
                'max:' . (Auth::user()->balance() <= -500 ? Auth::user()->balance() + 500 : 500),
            ],
        ];
    }
}
