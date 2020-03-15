<?php


namespace App\Filters;


use Doctrine\ORM\QueryBuilder;

abstract class BaseFilter
{
    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var QueryBuilder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $filters = [];

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }

    public function apply(QueryBuilder $builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            $this->callMethods($filter, $value);
        }

        return $this->builder;
    }

    protected function callMethods($filter, $value)
    {
        if (!method_exists($this, $filter)) {
            return;
        }

        $this->$filter($value);
    }

    protected function getFilters()
    {
        $filters = [];

        foreach ($this->filters as $filter) {
            if (array_key_exists($filter, $this->attributes)) {
                $filters[$filter] = $this->attributes[$filter];
            }
        }

        return $filters;
    }
}