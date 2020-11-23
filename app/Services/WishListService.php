<?php
 
namespace App\Services;
 
use App\Repositories\WishListRepositoryInterface;
use App\Repositories\WishListProductRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
 
class WishListService
{
	protected $wishListRepository;
	protected $wishListProductRepository;
	protected $userRepository;
    
	public function __construct(
		WishListRepositoryInterface $wishListRepository,
		WishListProductRepositoryInterface $wishListProductRepository,
		UserRepositoryInterface $userRepository
	) {
		$this->wishListRepository = $wishListRepository;
		$this->wishListProductRepository = $wishListProductRepository;
		$this->userRepository = $userRepository;
	}
 
	public function index()
	{
		$wishList = $this->wishListRepository->findUserWishList($this->userRepository->getId());
		if (is_null($wishList)) {
			return $data = []; 
		}
		$wishListProducts = $this->wishListProductRepository->findAllUserWishListProducts($wishList->id);
		$data = ['wishListProducts' => $wishListProducts];
		return $data;
	}
  
	public function delete($id)
	{
		\Session::flash('error','The product removed from your wishlist!');
		return $this->wishListProductRepository->delete($id);
	}

	public function getUserWishList($user_id)
	{
		$wishList = $this->wishListRepository->findUserWishList($user_id);
		if (!$wishList) {
            $wishList = $this->wishListRepository->create($user_id);
        }
		return $wishList;
	}

	public function addProductToWishList($product_id)
	{			
		$wishList = $this->getUserWishList($this->userRepository->getId());
		$wishListProduct = $this->wishListProductRepository->findUserWishListProduct($wishList->id, $product_id);
		if ($wishListProduct) {
			\Session::flash('error','The product already exists in your wishlist!');
            return $wishListProduct;
        }
        $wishListProduct = $this->wishListProductRepository->create($wishList->id, $product_id);
        \Session::flash('success','The product added to your wishlist successfully!'); 
        return $wishListProduct;     
    }
}	