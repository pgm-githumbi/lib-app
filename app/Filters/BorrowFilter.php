<?php

namespace App\Filters;

use App\Traits\Tables;
use Hashemi\QueryFilter\QueryFilter;

class BorrowFilter extends QueryFilter
{
    use Tables;
    public function applyUserIdProperty($userId,){
        return $this->builder->where($this->borrowUser, $userId);
    }

    public function applyBookIdProperty($bookId,){
        return $this->builder->where($this->borrowBook, $bookId);
    }
}
