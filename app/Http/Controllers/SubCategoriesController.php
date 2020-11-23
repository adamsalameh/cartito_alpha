<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubCategoryRequest;
use App\Services\SubCategoryService;

class SubCategoriesController extends Controller
{
    protected $subCategoryService;
    
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    /**
     * Display a listing of the subCategories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->subCategoryService->getAll();
        return view('subCategories.index', $data);
    }

    /**
     * Show the form for creating a new subCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->subCategoryService->getAllCategories();
        return view('subCategories.create', $data);
    }

    /**
     * Store a newly created subCategory in storage.
     *
     * @param  App\Http\Requests\StoreSubCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubCategoryRequest $request)
    {
        $this->subCategoryService->create($request);
        return redirect('/subCategories')->with('success','New SubCategory added successfully!');
    }

    
    /**
     * Show the form for editing the specified subCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->subCategoryService->edit($id);
        return view('subCategories.edit', $data);
    }

    /**
     * Update the specified subCategory in storage.
     *
     * @param  App\Http\Requests\StoreSubCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubCategoryRequest $request, $id)
    {
        $this->subCategoryService->update($request, $id);
        return redirect('/categories')->with('success','The SubCategory modifyed successfully!');
    }

    /**
     * Remove the specified subCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->subCategoryService->delete($id);
        return redirect("/categories")->with('success','Subcategory deleted successfully!');
    }
}
