<?php

namespace App\Repositories;

use App\User;
use Auth;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getId()
    {
        if (!$this->isLogged()) {
            return null;
        }
        return Auth::user()->id;
    }    
    
    public function all()
    {
        return $this->user->all();
    }

    public function find($id)
    {
        return $this->user->find($id);
    }

    public function isAdmin()
    {
        return Auth::user()->is_admin;
    }     
    
    public function isLogged()
    {
        if (Auth::guest()) {
            return false;
        }
        return true;
    }    

    public function delete($id)
    {
        return $this->user->find($id)->delete();
    }
}
