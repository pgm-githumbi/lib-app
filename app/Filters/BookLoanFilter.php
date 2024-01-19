<?php

namespace App\Filters;

use App\Traits\Tables;
use App\Models\BookLoan;
use Hashemi\QueryFilter\QueryFilter;

class BookLoanFilter extends QueryFilter
{
    use Tables;
    public function applyUserIdProperty($userId){
        return $this->builder->where($this->loanUser, $userId);
    }
    public function applyBookIdProperty($bookId){
        return $this->builder->where($this->loanBook, $bookId);
    }
    public function applyLoanStatusProperty($status){
        if (!in_array($status, BookLoan::LOAN_STATUSES)){
            $err_msg = "Invalid status. Use '".implode(', ', BookLoan::LOAN_STATUSES)."' instead.";
            abort(422, $err_msg);
        };
        return $this->builder->where($this->loanStatus, $status);
    }
    public function applyLoanDateProperty($loanDate){
        return $this->builder->where($this->loanDate, $loanDate);
    }
}
