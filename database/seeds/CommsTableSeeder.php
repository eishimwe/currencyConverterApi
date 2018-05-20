<?php

use Illuminate\Database\Seeder;

use App\CommRepository;

class CommsTableSeeder extends Seeder
{
    protected $comm;


    function __construct(CommRepository $comm)
    {
        $this->comm = $comm;
    }


    public function run()
    {
       $comms = [

         ['name' =>'Order Processed','to' =>'order@example.com']

       ];

       foreach ($comms as $comm){

           $this->comm->store($comm);
       }
    }

}
