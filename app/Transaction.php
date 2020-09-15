<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at'];
    public $timestamps = false;
}
