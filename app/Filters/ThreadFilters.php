<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilters 
{
    /**
    * @var Request
    */
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function apply($builder){

        if(!$username = $this->request->by){
            return $builder;
        }
        return $this->by($builder,$username);
    }

    /**
    * @param $builder
    * @param $username
    * @return mixed
    */
    public function by($builder, $username){
        $user = User::where('name', $username)->firstOrFail();
        return $builder->where('user_id',$user->id);
    }
}