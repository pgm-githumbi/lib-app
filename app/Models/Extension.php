<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;

    protected $fillable = ['penalty_id', 'extension_date', 'expected_return_date'];
    protected $casts = ['created_at'=>'datetime', 
                        'updated_at'=>'datetime'];

    protected $hidden = ['created_at','updated_at'];

    public function book_loan(){
        return $this->belongsTo(BookLoan::class, 'book_loan_id');
    }

    public function penalty(){
        return $this->belongsTo(Penalty::class);
    }
}
