<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    public $table = 'connections';
    protected $fillable = [
        'cid', 'appname', 'nid', 'gender', 'conaddress', 'contactno', 'billmonth', 'appdate'
    ];
}
