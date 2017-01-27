<?php

namespace LotVantage;

class EloquentToSql
{
    private $builder;

    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    public function toSql()
    {        
        $sql = $this->builder->toSql();
        $bindings = $this->builder->getBindings();

        return preg_replace_callback('/\?/', function () use (&$bindings) {
           return "'" . addslashes(array_shift($bindings)) . "'";
        }, $sql);

    }
}
