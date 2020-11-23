<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Services\AddressService;

class AddressesController extends Controller
{

    protected $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    
    /**
     * Display a listing of all user's addresses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->addressService->getAll();
        return view ('addresses.index', $data);
    }

    /**
     * Show the form for creating a new address.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Store a newly created address in storage.
     *
     * @param  App\Http\Requests\StoreAddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAddressRequest $request)
    {
        $this->addressService->create($request);
        return redirect ('/addresses')->with('success','Your new address added successfully!');
    }    

    /**
     * Show the form for editing the specified address.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->addressService->edit($id);
        return view('addresses.edit', $data);
    }

    /**
     * Update the specified address in storage.
     *
     * @param  App\Http\Requests\StoreAddressRequest  $request
     * @param  \App\address  $address_id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAddressRequest $request, $id)
    {   
        $this->addressService->update($request, $id);        
        return redirect ('/addresses')->with('success','Your address modified successfully!');
    }

    /**
     * Remove the specified address from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->addressService->delete($id);
        return redirect('/addresses')->with('success','Your address deleted successfully!');
    }
}
