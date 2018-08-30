<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Repositories\CountryRepository;
use App\Country;

class CountryController extends Controller
{
    /**
     * @var CountryRepository
     */
    protected $CountryRepository;

    /**
     * CountryController constructor.
     *
     * @param CountryRepository $CountryRepository
     */
    public function __construct(CountryRepository $CountryRepository)
    {
        $this->CountryRepository = $CountryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Countrys = request()->user()->Countrys;

        return response()->json([
            'Countrys' => $Countrys
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a new country and store.
     *
     * @param CountryRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CountryRequest $request)
    {
        $request_data = $request->only(['name']);
        $request_data['user_id'] = auth()->id();

        $Country = $this->CountryRepository->create($request_data);

        return response()->json([
            'Country' => $Country,
            'message'=> 'Success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $Country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $Country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $Country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $Country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CountryRequest $request
     * @param Country        $Country
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CountryRequest $request, Country $Country)
    {
        $request_data = $request->only(['name', 'description']);

        $this->CountryRepository->update($Country->id, $request_data);

        return response()->json([
            'message' => 'Country updated successful'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $Country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $Country)
    {
        $this->CountryRepository->delete($Country->id);
    }
}
