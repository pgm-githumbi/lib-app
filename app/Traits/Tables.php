<?php

namespace App\Traits;

Trait Tables{

    public $tableId = 'id';
    public $bookId = 'id';
    public $bookAvailable = 'available';


    public $users = 'users';
    public $userId = 'id';


    public $loanId = "id";
    public $loanBook = 'book_id';
    public $loanUser = 'user_id';
    public $loanStatus = "loan_status";
    public $loanDate = "loan_date";
    public $loanDueDate = "due_date";
    public $loanReturnDate = "return_date";

    public $borrowId = "id";
    public $borrowBook = "book_id";
    public $borrowUser = "user_id";
    public $borrowTable = "borrows";



    public $penaltiesId = "id";
    public $penaltiesLoan = 'book_loan_id';
    public $penaltiesAmount = 'penalty_amount_ksh';
    public $penaltiesAmountPaid = 'penalty_amount_paid_ksh';
    
    
    public $extensionsId = "id";
    public $extensionsLoan = 'book_loan_id';
    public $extensionsReturnDate = 'expected_return_date';
    public $extensionsPenalty = 'penalty_id';
    public $extensionsUser = 'book_loan.user';

    public $bookCategory = 'category_id';
    public $categoryId = 'id';
    public $categoryName = 'category_name';
    public $categoryCategory = 'super_category';
    

    public function usersTable() {
        return "users";
    }
    public function categoriesTable() { return "categories";}
    public function booksTable() { return "books";}
    public function bookLoansTable() { return "book_loans";}
    public function extensionsTable() { return "extensions";}
    public function penaltiesTable() { return "penalties";}

    public function penaltiesUser() { return $this->penaltiesLoan.'.'.$this->loanUser;}
}
