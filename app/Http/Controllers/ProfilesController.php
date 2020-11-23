<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Services\ProfileService;

class ProfilesController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Display a listing of all profiles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profiles = $this->profileService->getAll();
        return view('profiles.index', ['profiles' => $profiles]);
    }

    /**
     * Show the form for creating a new profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profiles.create');
    }

    /**
     * Store a newly created profile in storage.
     *
     * @param  App\Http\Requests\StoreProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfileRequest $request)
    {     
        $this->profileService->create($request);
        return redirect('/')->with('success','Your profile added successfully!');
    }

    /**
     * Display the specified profile.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = $this->profileService->findByUserId($id);
        return view('profiles.show', ['profile' => $profile]);
    }

    /**
     * Show the form for editing the specified profile.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = $this->profileService->edit($id);
        return view('profiles.edit', ['profile' => $profile] );
    }

    /**
     * Update the specified profile in storage.
     *
     * @param  App\Http\Requests\StoreProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProfileRequest $request, $id)
    {
        $profile = $this->profileService->update($request, $id);
        return redirect('/profiles/'.$profile->user_id)->with('success','Your profile modified successfully!');
    }

    /**
     * Remove the specified profile from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = $this->profileService->delete($id);
        return redirect('/')->with('success','Your profile deleted successfully!');
    }
}
