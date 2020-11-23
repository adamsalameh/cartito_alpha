<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use App\Services\BrandService;

class BrandsController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }

    /**
     * Display a listing of all brands.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->brandService->getAll();  
        return  view('brands.index', $data); 
    }

    /**
     * Show the form for creating a new brand.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created brand in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $this->brandService->create($request);
        return redirect('/brands')->with('success','New brand added successfully!');
    }

    
    /**
     * Show the form for editing the specified brand.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->brandService->edit($id);
        return view('brands.edit', $data);
    }

    /**
     * Update the specified brand in storage.
     *
     * @param  App\Http\Requests\StoreBrandRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBrandRequest $request, $id)
    {
        $this->brandService->update($request, $id);
        return redirect('/brands')->with('success','The brand modifyed successfully!');
    }

    /**
     * Remove the specified brand from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->brandService->delete($id);
        return redirect("/brands")->with('success','brand deleted successfully!');
    }
}
