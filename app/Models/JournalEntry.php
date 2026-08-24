<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    public $fillable = ['account_id', 'transaction_id', 'amount', 'direction'];
}
