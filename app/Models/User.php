<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Enums\TransactionTypes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function balance()
    {
        return $this->transactions()->sum('amount');
    }

    public function deposit(float $amount, float $fee)
    {
        return $this->transactions()->create([
            'type' => TransactionTypes::DEPOSIT->value,
            'amount' => $amount - $fee,
            'fee' => -$fee,
        ]);
    }

    public function withdraw(float $amount)
    {
        return $this->transactions()->create([
            'type' => TransactionTypes::WITHDRAW->value,
            'amount' => -$amount,
            'fee' => 0,
        ]);
    }
}
