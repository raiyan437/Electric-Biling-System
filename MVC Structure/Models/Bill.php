<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $table = 'bills';
    protected $fillable = [
        'bid', 'conid', 'billmonth', 'billyear', 'amount', 'status'
    ];
}
