<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    protected $guarded = [];
    protected $dates = ['created_at'];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    /**
     * Transactions by deposit
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions() {
        return $this->hasMany('App\Transaction', 'deposit_id', 'id');
    }

    /**
     * @return float|int get amount of accure
     */
    public function getAccrueAttribute() {
        return $this->attributes['invested'] / 100 * $this->attributes['percent'];
    }
}
