<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounst';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'accoun_id');
    }

    public function transaction() {
        return $this->hasMany(Transaction::class, 'transaction_id');
    }

}
