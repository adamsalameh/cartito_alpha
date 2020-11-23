<?php

namespace App\Repositories;

use App\Address;

class AddressRepository implements AddressRepositoryInterface
{
    protected $address;

    public function __construct(Address $address)
    {
        $this->address = $address;
    }
    
    public function create($attributes)
    {
        return $this->address->create($attributes);
    }
    
    public function all()
    {
        return $this->address->all(); 
    }

    public function allUserAddresses($user_id)
    {
        return $this->address->all()->where('user_id',$user_id);
    }

    public function find($id)
    {
        return $this->address->findOrFail($id);
    }

    public function update($attributes)
    {
        return $this->address->update($attributes);
    }

    public function delete($id)
    {
        return $this->address->findOrFail($id)->delete();
    }
}
