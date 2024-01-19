<?php

namespace App\Models;

use App\Models\Book;

use App\Models\BookCategory;
use App\Traits\Tables;
use Hashemi\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Filterable, Tables;
    //public $table = 'categories';
    protected $fillable = ['category_name'];

    protected $casts = ['created_at' => 'datetime',
                         'updated_at' => 'datetime', 
                        'deleted_at' => 'datetime'];
    
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function category(){
        return $this->belongsTo(Category::class, $this->categoryCategory);
    }

    public function book_category(){
        return $this->hasMany(BookCategory::class);
    }

    public function books(){
        return $this->hasMany(Book::class);
    }
}
