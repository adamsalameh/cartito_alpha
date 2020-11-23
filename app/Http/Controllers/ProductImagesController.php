<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Services\ProductImageService;

class ProductImagesController extends Controller
{
    private $productImageService;

    public function __construct(ProductImageService $productImageService)
    {
        $this->productImageService = $productImageService;
    }

    /**
     * Display a listing of all the images for specified product.
     *
     * @return \Illuminate\Http\Response
     */
    public function all($product_id)
    {
        $data = $this->productImageService->getAllProductImage($product_id);
        return view('productImages.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        return view('productImages.create',['product_id' => $product_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImageRequest $request)
    {        
        $this->productImageService->store($request);
        return redirect('/products')->with('success','New Image added successfully!');
    }

    /**
     * Show the form for editing the specified product's image.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->productImageService->edit($id);
        return view('productImages.edit', $data);
    }

    /**
     * Update the specified product's image in storage.
     *
     * @param  App\Http\Requests\StoreImageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreImageRequest $request, $id)
    {
        $this->productImageService->update($request, $id);
        return redirect('/products')->with('success','The image modifyed successfully!');        
    }

    /**
     * Remove the specified product's image  from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productImageService->delete($id);
        return redirect("/")->with('success','image deleted successfully!');

    }
}
