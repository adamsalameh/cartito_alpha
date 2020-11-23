<?php

namespace App\Http\Controllers;

use App\Services\CheckOutService;
use App\Http\Requests\StoreCartRequest;

class CheckOutController extends Controller
{
    protected $checkOutService;

    public function __construct(CheckOutService $checkOutService)
    {
        $this->checkOutService = $checkOutService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {         
        $data = $this->checkOutService->index();
        return view('checkOut.guest', $data);             
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guest()
    {   
        $data = $this->checkOutService->index();
        return view('checkOut.guest', $data);            
    }

    
}


