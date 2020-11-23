<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShippingMethodRequest;
use App\Services\ShippingMethodService;

class ShippingMethodsController extends Controller
{
    protected $shippingMethodService;

    public function __construct(ShippingMethodService $shippingMethodService)
    {
        $this->shippingMethodService = $shippingMethodService;
    }

    /**
     * Display a listing of the shipping methods.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->shippingMethodService->getAll();
        return view('shippingMethods.index', $data);
    }

    /**
     * Show the form for creating a new shipping method.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shippingMethods.create');
    }

    /**
     * Store a newly created shipping method in storage.
     *
     * @param  App\Http\Requests\StoreShippingMethodRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingMethodRequest $request)
    {
        $this->shippingMethodService->create($request);
        return redirect('/shippingMethods')->with('success','New shipping method added successfully!');
    }

    /**
     * Show the form for editing the specified shipping method.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->shippingMethodService->edit($id);
        return view('shippingMethods.edit', $data);
    }

    /**
     * Update the specified shipping method in storage.
     *
     * @param  App\Http\Requests\StoreShippingMethodRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreShippingMethodRequest $request, $id)
    {
        $this->shippingMethodService->update($request, $id);      
        return redirect('/shippingMethods')->with('success','The shipping method modifyed successfully!');
    }

    /**
     * Remove the specified shipping method from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->shippingMethodService->delete($id);
        return redirect("/shippingMethods")->with('success','shipping method deleted successfully!');
    }
}
