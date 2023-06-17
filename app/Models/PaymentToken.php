<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentToken extends Model
{
    use HasFactory;
    protected $table = 'payment_tokens';
    protected $guarded = ['id'];
}
