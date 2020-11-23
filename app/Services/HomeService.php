<?php
 
namespace App\Services;
 
use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use App\Repositories\BrandRepository;
use App\Http\Requests\StoreProductRequest;
use App\Repositories\SubCategoryRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\PromotionRepository;
 
class HomeService
{
    protected $productRepository;
    protected $categoryRepository;
    protected $subCategoryRepository;
    protected $brandRepository;
    protected $promotionRepository; 

    public function __construct(
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository,
        BrandRepository $brandRepository,
        PromotionRepository $promotionRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->brandRepository = $brandRepository;
        $this->promotionRepository = $promotionRepository;
    }
 
    public function index()
    {
        $products = $this->productRepository->paginate();
        foreach ($products as $product) {
            if ($this->promotionRepository->isValid($product->promotion_id)) {
                $product->promotionPrice = $this->promotionRepository->promotionPrice($product->promotion_id, $product->price);
            }
        }
        $categories = $this->categoryRepository->all();
        $data = [
            'products' => $products,
            'categories' => $categories
        ];
        return $data;
    }     
}