<?php

namespace App\Repositories;

use App\Profile;

class ProfileRepository implements ProfileRepositoryInterface
{
    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
    
    public function create($attributes)
    {
        return $this->profile->create($attributes);
    }
    
    public function all()
    {
        return $this->profile->all();
    }
    
    public function find($id)
    {
        return $this->profile->findOrFail($id);
    }

    public function findByUserId($userId)
    {
        return $this->profile->where('user_id',$userId)->first();
    }

    public function update($attributes)
    {
        return $this->profile->update($attributes);
    }

    public function delete($id)
    {
        return $this->profile->findOrFail($id)->delete();
    }
}