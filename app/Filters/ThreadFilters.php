<?php

namespace App\Filters;
use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by','popular'];
    /**
    * @param string $username
    * @return mixed
    */
    protected function by($username){
        $user = User::where('name', $username)->firstOrFail();
        return $this->builder->where('user_id',$user->id);
    }
    /**
    * @return $this
    */
    protected function popular($username){
        $this->builder->getQuery()->orders =[];
        return $this->builder->orderBy('replies_count','desc');
    }



}