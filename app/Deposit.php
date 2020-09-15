<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at'];
    public $timestamps = false;

    /**
     * Transactions by deposit
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany('App\Transaction', 'deposit_id', 'id');
    }
}
