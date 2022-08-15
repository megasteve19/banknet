<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Account\Deposit;
use App\Http\Requests\Account\Index;
use App\Http\Requests\Account\Withdraw;

use App\Models\User;

class Account extends Controller
{
    public function index(Index $request)
    {
        return Inertia::render('Account', [
            'balance' => Auth::user()
                ->balance(),
            'transactions' => Auth::user()
                ->transactions()
                ->get(),
        ]);
    }

    public function deposit(Deposit $request)
    {
        if($request->user()->balance() < 0)
        {
            $fee = $request->amount * 0.02;
        }

        if($request->user()->deposit($request->amount, $fee ?? 0))
        {
            return redirect()
                ->route('account.index');
        }
    }

    public function withdraw(Withdraw $request)
    {
        if($request->user()->withdraw($request->amount))
        {
            return redirect()
                ->route('account.index');
        }
    }
}
