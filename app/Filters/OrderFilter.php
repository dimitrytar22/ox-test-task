<?php

namespace App\Filters;

class OrderFilter extends QueryFilter
{
    public function status_id($id = null)
    {
        if(!$id)
            return $this->builder;
        return $this->builder->where('status_id', $id);
    }
}
