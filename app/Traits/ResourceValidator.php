<?php

namespace App\Traits;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Penalty;

Trait ResourceValidator{

    private function validateBook(string $book_id){
        $book = Book::find($book_id);
        if(empty($book)) abort(404, "Book not found");
    }

    private function validateBookLoan(string $book_loan_id, string $book_id=null){
        $loan = BookLoan::find( $book_loan_id );
        if(empty($loan)){ abort(404, "Loan not found"); }

        if(!$book_id) return;

        $book = Book::with('book_loans')->find($book_id);
        if(empty($book)){ abort(404, "Book not found"); }

        $the_books_loans_ids = $book->book_loans->pluck('id')->toArray();
        if(!in_array($loan->id, $the_books_loans_ids)){
            abort(401, "Loan ".$loan->id." not found in book '".$book->name."'");
        }
        return;
    }

    private function validatePenalty(string $penalty_id, string $loan_id = null, string $book_id = null){
        $penalty = Penalty::find($penalty_id);
        if(empty($penalty)){
            abort(404, "Penalty not found");
        }   

        if(!$loan_id) return;

        return $this->validateBookLoan($loan_id, $book_id);
    }

    private function validateLoansUser($loan_id, $user_id, 
            $error_code = 401, $error_message = 'unauthorized'){
        $loan = BookLoan::find($loan_id);
        if(empty($loan)){
            abort(404, 'Loan not found');
        }
        if($user_id != $loan->user_id){
            abort($error_code, $error_message);
        } 
        return;
    }

    private function validateModelExists($model_name, $model_id){
    
        $model = app($model_name);
        if (empty($model::find($model_id))){
            abort(404, $model_name.' not found');
        }   

        return true;
    
    }

    private function validateModelExistsWith($model1_name, $model1_id, $foreign_key, $model2_id){
        $model1 = app($model1_name);
        $row = $model1::findOrFail($model1_id);
        if ($row->{$foreign_key} != $model2_id){
            abort(400,"Incorrect ".$foreign_key." found for given ".$model1_name );
        }
        return;
    }
}