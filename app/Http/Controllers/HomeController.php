<?php

namespace App\Http\Controllers;

use App\Services\HomeService;


class HomeController extends Controller
{

    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = $this->homeService->index();
        return view('home', $data);
    }    
}
