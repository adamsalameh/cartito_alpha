<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreImageRequest;
use App\Repositories\ProductImageRepositoryInterface;
 
class ProductImageService
{
	protected $productImageRepository;

	public function __construct(ProductImageRepositoryInterface $productImageRepository)
	{
		$this->productImageRepository = $productImageRepository;
	}
 
	public function getAllProductImage($product_id)
	{
		$images = $this->productImageRepository->findAllByProductId($product_id);
		return ['images' => $images];
	}
 
    public function store(StoreImageRequest $request)
	{
		$imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move("views.upload", $imageName);        
       
		return $this->productImageRepository->create($request->validated() + [
            'product_id' => $request['product_id'],
            'image_path' => "views.upload/"."$imageName",

		]);		
	}

	public function edit($id)
	{
		$productImage = $this->productImageRepository->find($id);
		return ['productImage' => $productImage];
	}
 
	public function update(StoreImageRequest $request, $id)
	{
		$imageName = time().'.'.$request->image->getClientOriginalExtension();
	    $productImage = $this->productImageRepository->find($id);
	    // delete the image from the folder and upload the new one
        unlink($productImage->image_path);
        $request->image->move("views.upload", $imageName);   

        $productImage->image_path = "views.upload/"."$imageName";
        $productImage->save();
        return $productImage;
	}
 
	public function delete($id)
	{
		unlink($this->productImageRepository->find($id)->image_path);
		return $this->productImageRepository->delete($id);
	}
}