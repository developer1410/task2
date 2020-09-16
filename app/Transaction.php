<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    const TYPE_ADD_BALANCE = 'enter';
    const TYPE_CREATE_DEPOSIT = 'create_deposit';
    const TYPE_ADD_PERCENTS = 'accrue';

    protected $guarded = [];
    protected $dates = ['created_at'];
    public $timestamps = false;
}
