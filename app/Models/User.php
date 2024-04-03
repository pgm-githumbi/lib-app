<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\AuthorizationNames;
use Hashemi\QueryFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Filterable,
        HasRoles, AuthorizationNames;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function book_loans(){
        return $this->hasMany(BookLoan::class);
    }

    public function penalties(){
        return $this->hasManyThrough(
            Penalty::class, BookLoan::class,
            'user_id', 'book_loan_id', 'id', 'id'
        );
    }

    public function extensions() {
        return $this->hasManyThrough(
            Extension::class,
            BookLoan::class,
            'user_id', 'loan_id', 'id', 'id'
        );
    }

    protected static function boot()
    {
        parent::boot();

        
        static::created(function ($user) {
            // Assign the default role to the user when created
            $user->assignRole('student');
            
        });
    }
}
