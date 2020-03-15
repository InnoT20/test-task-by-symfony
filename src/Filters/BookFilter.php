<?php


namespace App\Filters;


class BookFilter extends BaseFilter
{
    protected $filters = ['genre', 'author'];

    protected function genre($genre)
    {
        return $this->builder->andWhere('b.genre = :genre')->setParameter('genre', $genre);
    }

    protected function author($author)
    {
        return $this->builder->andWhere('b.author = :author')->setParameter('author', $author);
    }
}