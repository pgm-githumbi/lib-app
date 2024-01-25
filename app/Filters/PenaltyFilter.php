<?php

namespace App\Filters;

use App\Traits\Tables;
use Hashemi\QueryFilter\QueryFilter;

class PenaltyFilter extends QueryFilter
{
    use Tables;
    public function applyUserIdProperty($userId){
        return $this->builder->where($this->penaltiesUser(), $userId);
    }
    public function applyIdProperty($id){
        return $this->builder->where($this->penaltiesId, $id);
    }
    public function applyPenaltyAmountKshExactProperty($penAmt){
        return $this->builder->where($this->penaltiesAmount, $penAmt);
    }
}
