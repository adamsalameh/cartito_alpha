<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreBrandRequest;
use App\Repositories\BrandRepositoryInterface;
 
class BrandService
{
	protected $brandRepository;

	public function __construct(BrandRepositoryInterface $brandRepository)
	{
		$this->brandRepository = $brandRepository;
	}
 
	public function getAll()
	{
		$brands = $this->brandRepository->all();
		return ['brands' => $brands];
	}
 
    public function create(StoreBrandRequest $request)
	{
		return $this->brandRepository->create($request->validated());		
	}

	public function edit($id)
	{
		$brand = $this->brandRepository->find($id);
		return ['brand' => $brand];
	}
 
	public function update(StoreBrandRequest $request, $id)
	{
	    return $this->brandRepository->find($id)->update($request->validated());
	}
 
	public function delete($id)
	{
		return $this->brandRepository->delete($id);
	}
}