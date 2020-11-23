<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreShippingMethodRequest;
use App\Repositories\ShippingMethodRepository;
 
class ShippingMethodService
{
	protected $shippingMethodRepository;

	public function __construct(ShippingMethodRepository $shippingMethodRepository)
	{
		$this->shippingMethodRepository = $shippingMethodRepository;
	}
 
	public function getAll()
	{
		$shippingMethods = $this->shippingMethodRepository->all();
		return ['shippingMethods' => $shippingMethods];
	}
 
    public function create(StoreShippingMethodRequest $request)
	{
	    return $this->shippingMethodRepository->create($request->validated());	
	}

	public function edit($id)
	{
		$shippingMethod = $this->shippingMethodRepository->find($id);
		return ['shippingMethod' => $shippingMethod];
	}
 
	public function update(StoreShippingMethodRequest $request, $id)
	{
	    return $this->shippingMethodRepository->find($id)->update($request->validated());
	}
 
	public function delete($id)
	{
		return $this->shippingMethodRepository->delete($id);
	}
}