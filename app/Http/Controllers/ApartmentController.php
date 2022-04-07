<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Building $building)
    {
        return view('apartments.form', compact('building'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Building $building)
    {
        $form_rules = [
            'number' => [
                'required',
                'string',
                'max:255', 
                Rule::unique('apartments')->where(fn ($query) => $query->where('building_id', $building->id))
            ],
            'floor' => ['nullable','integer','between:0,255'],
            'garages' => ['nullable','integer','between:0,255'],
            'bathrooms' => ['nullable','integer','between:0,255'],
            'bedrooms' => ['nullable','integer','between:0,255'],
            'monthly_rent' => ['nullable','numeric', 'between:0,99999.99'],
        ];

        $request->validate($form_rules);

        $building->apartments()->create(array_filter($request->all()));

        return redirect('/buildings/'.$building->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        //
    }
}
