<?php
 
namespace App\Services;
 
use App\Http\Requests\StoreSubCategoryRequest;
use App\Repositories\SubCategoryRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\BrandRepositoryInterface;
use Illuminate\Support\Str;
 
class SubCategoryService
{
	protected $subCategoryRepository;
	
	public function __construct(
		SubCategoryRepositoryInterface $subCategoryRepository,
		CategoryRepositoryInterface $categoryRepository,
		BrandRepositoryInterface $brandRepository
	) {
		$this->subCategoryRepository = $subCategoryRepository;
		$this->categoryRepository = $categoryRepository;
		$this->brandRepository = $brandRepository;		
	}
 
	public function getAll()
	{
		$subCategories = $this->subCategoryRepository->all();
		return ['subCategories' => $subCategories];
	}

    public function create(StoreSubCategoryRequest $request)
	{

	    return $this->subCategoryRepository->create($request->validated() + [
	        	'slug' => Str::slug($request->title, '-')
	        ]);	
	}

	public function edit($id)
	{
		$categories = $this->categoryRepository->all();
		$subCategory = $this->subCategoryRepository->find($id);
		$data = ['subCategory' => $subCategory, 'categories' => $categories];
		return $data;
	}
 
	public function update(StoreSubCategoryRequest $request, $id)
	{    
        return $this->subCategoryRepository->find($id)->update($request->validated() + [
	        	'slug' => Str::slug($request->title, '-')
	        ]);
	}
 
	public function delete($id)
	{
		return $this->subCategoryRepository->delete($id);
	}

	public function getAllCategories()
	{
		$categories = $this->categoryRepository->all();
		return $data = ['categories' => $categories];		
	}
}