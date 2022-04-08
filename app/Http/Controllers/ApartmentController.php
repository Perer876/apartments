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
    public function index(Request $request, Building $building)
    {
        if ($building->id) 
        {
            return view('apartments.index', [
                'apartments' => $building->apartments,
                'building' => $building,
                'view' => $request->query('view') ?? 'table',
                'request' => $request,
            ]);
        }
        else 
        {
            return view('apartments.index', [
                'apartments' => Apartment::all(),
                'view' => $request->query('view') ?? 'table',
                'request' => $request,
            ]);
        }
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
        return view('apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $building = $apartment->building;
        return view('apartments.form', compact('apartment', 'building'));
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
        $form_rules = [
            'number' => [
                'required',
                'string',
                'max:255', 
                Rule::unique('apartments')
                    ->where(fn ($query) => $query->where('building_id', $apartment->building->id))
                    ->ignore($apartment->id)
            ],
            'floor' => ['nullable','integer','between:0,255'],
            'garages' => ['nullable','integer','between:0,255'],
            'bathrooms' => ['nullable','integer','between:0,255'],
            'bedrooms' => ['nullable','integer','between:0,255'],
            'monthly_rent' => ['nullable','numeric', 'between:0,99999.99'],
        ];

        $request->validate($form_rules);

        Apartment::where('id', $apartment->id)->update(array_filter($request->except(['_method', '_token'])));

        return redirect('/apartments/' . $apartment->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();
        return redirect('/buildings/' . $apartment->building_id);
    }
}
