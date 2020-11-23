<?php

namespace App\Repositories;

interface AddressRepositoryInterface
{
    public function create($attributes);    
    public function all();
    public function allUserAddresses($user_id);
    public function find($id);
    public function update($attributes);
    public function delete($id);
}