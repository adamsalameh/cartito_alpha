<?php
 
namespace App\Services;
 
use App\Http\Requests\StorePromotionRequest;
use App\Repositories\PromotionRepositoryInterface;
 
class PromotionService
{ 
    protected $promotionRepository; 

    public function __construct(PromotionRepositoryInterface $promotionRepository)
    {
        $this->promotionRepository = $promotionRepository;
    }
 
    public function getAll()
    {
        $promotions = $this->promotionRepository->all();
        $data = ['promotions' => $promotions];
        return $data;
    }    
 
    public function store(StorePromotionRequest $request)
    {        
        return $this->promotionRepository->create($request->validated()); 
    }

    public function edit($id)
    {
        $promotion = $this->promotionRepository->find($id);
        $data = ['promotion' => $promotion];
        return $data;

    }
 
    public function update(StorePromotionRequest $request, $id)
    {        
        return $this->promotionRepository->find($id)->update($request->validated());
    }
 
    public function delete($id)
    {
        return $this->promotionRepository->delete($id);
    }  
}