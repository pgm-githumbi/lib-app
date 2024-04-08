<?php

namespace App\Filters;

use App\Models\User;
use Hashemi\QueryFilter\QueryFilter;

class UserFilter extends QueryFilter
{
    public function applyNameProperty($name)
    {
        return $this->builder->where("name", $name);
    }

    public function applyNameRegexProperty($name)
    {
        return $this->builder->where("name", 'LIKE', '%' . $name . '%');
    }

    public function applyIdFilter($id)
    {
        return $this->builder->where("id", $id);
    }

    public function applyEmailFilter($email)
    {
        $this->builder->where("email", $email);
    }
}
