<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreCategoryRequest;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Support\Str;
 
class CategoryService
{
	protected $categoryRepository;

	public function __construct(CategoryRepositoryInterface $categoryRepository)
	{
		$this->categoryRepository = $categoryRepository;
	}
 
	public function getAll()
	{
		$categories = $this->categoryRepository->all();
		return ['categories' => $categories];
	}
 
    public function create(StoreCategoryRequest $request)
	{
	    return $this->categoryRepository->create($request->validated() + [
	        	'slug' => Str::slug($request->title, '-')
	        ]);	
	}

	public function edit($id)
	{
		$category = $this->categoryRepository->find($id);
		return ['category' => $category];
	}
 
	public function update(StoreCategoryRequest $request, $id)
	{	    
        return $this->categoryRepository->find($id)->update($request->validated() + [
	        	'slug' => Str::slug($request->title, '-')
	        ]);
	}
 
	public function delete($id)
	{		
        return $this->categoryRepository->delete($id);
	}
}