<?php

namespace App\Models;

use Hashemi\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['penalty_amount_ksh', 'penalty_amount_paid_ksh'];
    protected $casts = ['created_at' => 'datetime',
                        'updated_at'=> 'datetime'];
    protected $hidden = ['created_at', 'updated_at'];

    public function book_loan(){
        return $this->belongsTo(BookLoan::class);
    }

}
