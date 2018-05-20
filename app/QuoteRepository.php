<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/19
 * Time: 7:10 PM
 */

namespace App;


class QuoteRepository implements RepositoryInterface
{
    protected $quote;

    function __construct(Quote $quote)
    {
        $this->quote = $quote;
    }


    function store($data)
    {
        return $this->quote->create($data);
    }

    function find($id){

        return $this->quote->find($id);
    }

}