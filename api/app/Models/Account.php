<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'balance', 'currency', 'user_id', 'email', 'password',
    ];

    /**
     * Check(verify) overspending
     */
    public function isOverspendingBalance($amount){      
        if($amount > $this->balance) {
            return true;
        } 

        return false;
    }

    /**
     * Debit (decrement) account balance
     */
    public function debitAccountBalance($amount){
        $this->decrement('balance', $amount);

        return;
    }

     /**
      * Credit (increment) account balance
      */
      public function creditAccountBalance($amount){
          $this->increment('balance', $amount);

          return;
      }
}