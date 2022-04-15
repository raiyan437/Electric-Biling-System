<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $table = 'payments';
    protected $fillable = [
        'pid', 'conid', 'bid', 'amount', 'txnid', 'method', 'status'
    ];
}
