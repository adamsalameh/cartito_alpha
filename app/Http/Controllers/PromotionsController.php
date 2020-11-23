<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePromotionRequest;
use App\Services\PromotionService;

class PromotionsController extends Controller
{
    protected $promotionService;

    public function __construct(PromotionService $promotionService)
    {
        $this->promotionService = $promotionService;
    }

    /**
     * Display a listing of all promotions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->promotionService->getAll();
        return view('promotions.index', $data);
    }

    /**
     * Show the form for creating a new promotion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promotions.create');
    }

    /**
     * Store a newly created promotion in storage.
     *
     * @param  App\Http\Requests\StorePromotionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        $this->promotionService->store($request);
        return redirect('/promotions')->with('success','New promotion added successfully!');
    }

    /**
     * Show the form for editing the specified promotion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->promotionService->edit($id);
        return view('promotions.edit', $data);
    }

    /**
     * Update the specified promotion in storage.
     *
     * @param  App\Http\Requests\StorePromotionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePromotionRequest $request, $id)
    {
        $this->promotionService->update($request, $id);      
        return redirect('/promotions')->with('success','The promotion modifyed successfully!');
    }

    /**
     * Remove the specified promotion from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->promotionService->delete($id);
        return redirect("/promotions")->with('success','promotion deleted successfully!');
    }
}
