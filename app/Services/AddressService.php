<?php
 
namespace App\Services;

use App\Http\Requests\StoreAddressRequest; 
use App\Repositories\AddressRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
 
class AddressService
{
	protected $addressRepository;
	protected $userRepository;

	public function __construct(
		AddressRepositoryInterface $addressRepository,
		UserRepositoryInterface $userRepository
	) {
		$this->addressRepository = $addressRepository;
		$this->userRepository = $userRepository;
	}
 
	public function getAll()
	{		
		$addresses = $this->addressRepository->allUserAddresses($this->userRepository->getId());
		return $data = ['addresses' => $addresses];
	}
 
    public function create(StoreAddressRequest $request)
	{
		return $this->addressRepository->create(
			$request->validated() + ['user_id' => $this->userRepository->getId()]
		);		
	}

	public function edit($id)
	{
		$address = $this->addressRepository->find($id);
		return $data = ['address' => $address];
	}
 
	public function update(StoreAddressRequest $request, $id)
	{
	    $address = $this->addressRepository->find($id);
	    $address->update(
	    	$request->validated() + ['user_id' => $address->user_id]
	    );
	    return $address;
	}
 
	public function delete($id)
	{
		return $this->addressRepository->delete($id);		
	}
}