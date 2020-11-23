<?php
 
namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\BrandRepositoryInterface;
use App\Repositories\SubCategoryRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\PromotionRepositoryInterface;
use Illuminate\Support\Str;
use App\Traits\PromotionTrait;

 
class ProductService
{
    use PromotionTrait;

    protected $productRepository;
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $brandRepository;
    protected $promotionRepository; 

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        SubCategoryRepositoryInterface $subCategoryRepository,
        BrandRepositoryInterface $brandRepository,
        PromotionRepositoryInterface $promotionRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->brandRepository = $brandRepository;
        $this->promotionRepository = $promotionRepository;
    }
 
    public function index()
    {
        $products = $this->productRepository->all();
        $data = ['products' => $products];
        return $data;
    }

    public function show($id)
    {
        $categories = $this->categoryRepository->all();
        $product = $this->productRepository->find($id);
        $promotion = $this->promotionRepository->isValid($product->promotion_id);
        if ($promotion) {
            $product->promotionPrice = $this->promotionPrice($promotion, $product->price);
        }
        $data = ['product' => $product,'categories' => $categories];
        return $data;
    }

    // get All categoris, subCategories, brands, and promotions to create a new product
    public function getDataToCreate()
    {
        $categories = $this->categoryRepository->all();
        $subCategories = $this->subCategoryRepository->all();
        $brands = $this->brandRepository->all();
        $promotions = $this->promotionRepository->all(); 

        $data = [
            'categories'    => $categories,
            'subCategories' => $subCategories,
            'brands'        => $brands,
            'promotions'    => $promotions
        ];
        return $data;
    }
 
    public function store(StoreProductRequest $request)
    {        
        return $this->productRepository->create($request->validated() + [
            'promotion_id' => request('promotion_id'),            
            'slug' => Str::slug($request->title, '-')
        ]); 
    }

    public function edit($id)
    {
        $categories = $this->categoryRepository->all();
        $subCategories = $this->subCategoryRepository->all();
        $brands = $this->brandRepository->all();
        $promotions = $this->promotionRepository->all();
        $product = $this->productRepository->find($id);

        $data = [
            'categories'    => $categories,
            'subCategories' => $subCategories,
            'brands'        => $brands,
            'promotions'    => $promotions,
            'product'       => $product
        ];
        return $data;
    }
 
    public function update(StoreProductRequest $request, $id)
    {
        
        return $this->productRepository->find($id)->update($request->validated() + [
            'promotion_id' => request('promotion_id'),
            'slug' => Str::slug($request->title, '-')           
        ]);
    }
 
    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getProductsBySubCategoryAndBrand($subCategory ,$request)
    {
        $priceSort = $request['priceSort'];
        $selectedBrands = $request['selectedBrands'];
        if (!$request['selectedBrands']) {
            $products = $this->productRepository->getProductsBySubCategory($subCategory, $priceSort);
        } else {
            $products = $this->productRepository->getProductsBySubCategoryAndBrand($subCategory, $priceSort, $selectedBrands);
        }

        $categories = $this->categoryRepository->all();
        $subCategories = $this->subCategoryRepository->all();
        $brands = $this->brandRepository->all();
        $promotions = $this->promotionRepository->all();
                
        $data = [
            'categories'    => $categories,
            'subCategories' => $subCategories,
            'brands'        => $brands,
            'promotions'    => $promotions,
            'products'      => $products,
            'subCategory'   => $subCategory
        ];
        return $data;
    }
}