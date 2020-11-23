<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreProfileRequest;
use App\Repositories\ProfileRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
 
class ProfileService
{
	protected $profileRepository;

	public function __construct(
		ProfileRepositoryInterface $profileRepository,
	    UserRepositoryInterface $userRepository
    ) {
		$this->profileRepository = $profileRepository;
		$this->userRepository = $userRepository;
	}
	
    // return a listing of all users' profiles.     
	public function getAll()
	{
		return $this->profileRepository->all();
	}

    public function create(StoreProfileRequest $request)
	{
		if (!$this->profileRepository->findByUserId($this->userRepository->getId())) {
	        return $this->profileRepository->create($request->validated() + [
	        	'user_id' => $this->userRepository->getId()
	        ]);
		}
	}

	public function edit($id)
	{
		return $this->profileRepository->find($id);
	}
 
	public function update(StoreProfileRequest $request, $id)
	{
	    $profile = $this->profileRepository->find($id);
	    $profile->update($request->validated() + [
	    	'user_id' => $profile->user_id
	    ]);	    
	    return $profile;
	}
 
	public function delete($id)
	{
		return $this->profileRepository->delete($id);		
	}

    /**
     * find a user's profile by user's id     
     * @param  int  $user_id    
     */
	public function findByUserId($user_id)
	{
		if ($this->userRepository->isAdmin() || $this->userRepository->getId() == $user_id) {
			return $this->profileRepository->findByUserId($user_id);		   
		}        
	}

	/**
     * find the user's profile     
     * @param  int  $user_id    
     */
	public function findMyProfile()
	{
        $profile = $this->profileRepository->findByUserId($this->userRepository->getId());
		return $profile;		
	}
}