<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getId();     
    public function all();    
    public function find($id);    
    public function isAdmin();        
    public function delete($id);    
}
