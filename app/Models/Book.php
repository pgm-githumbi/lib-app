<?php

namespace App\Models;

use Hashemi\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory, Filterable;

    protected $fillable = ['name', 'publisher', 'isbn', 'description'];
    protected $casts = ['created_at' => 'datetime', 
                        'updated_at' => 'datetime'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function book_category() {
        return $this->belongsTo(BookCategory::class);
    }

    public function book_loans() {
        return $this->hasMany(BookLoan::class);
    }
}
