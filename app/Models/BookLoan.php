<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Penalty;
use App\Traits\Tables;
use Hashemi\QueryFilter\Filterable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Status extends Enum
{
    const PAID = 'piad';
    const UNPAID = 'unpaid';
    
}

class BookLoan extends Model
{
    use HasFactory, Filterable, Tables;

    const PAID = Status::PAID;
    const UNPAID = Status::UNPAID;
    const LOAN_STATUSES = [BookLoan::UNPAID, BookLoan::PAID,];
   
    protected $casts = ['created_at'=>'datetime', 
    'updated_at'=>'datetime'];
    protected $fillable = ['user_id', 'book_id', 'loan_status', 'due_date', 
                        'return_date'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function added_by(){
        return $this->belongsTo(User::class, 'added_by');
    }
    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function penalties(){
        return $this->hasMany(Penalty::class);
    }

    public function extensions(){
        return $this->hasMany(Extension::class);
    }
}
