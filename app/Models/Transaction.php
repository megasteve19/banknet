<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'type',
        'amount',
        'fee',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
