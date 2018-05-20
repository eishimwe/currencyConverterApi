<?php
/**
 * Created by PhpStorm.
 * User: Elie.Ishimwe
 * Date: 2018/05/20
 * Time: 6:16 AM
 */

namespace App;


class CommRepository implements RepositoryInterface
{
    protected $comm;

    function __construct(Comm $comm)
    {
        $this->comm = $comm;
    }

    function store($data)
    {
        return $this->comm->create($data);

    }

    function find($id){

        return $this->comm->find($id);
    }

    function findByName($name){

        return $this->comm->where('name',$name)->first();
    }

}