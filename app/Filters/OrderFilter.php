<?php

namespace App\Filters;

class OrderFilter extends QueryFilter
{
    public function status_id($id)
    {
        return $this->builder->where('status_id', $id);
    }
}
