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
    public function index(Building $building)
    {
        $this->authorize('viewAny', Apartment::class);

        if ($building->id) 
        {
            return view('resources.apartments.index', [
                'building' => $building
            ]);
        }
        else 
        {
            return view('resources.apartments.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Building $building)
    {
        $this->authorize('create', [Apartment::class, $building]);
        return view('resources.apartments.form', compact('building'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Building $building)
    {
        $this->authorize('create', [Apartment::class, $building]);
        
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

        session()->push('messages', [
            'text' => 'Departamento agregado satisfactoriamente.',
            'color' => 'primary',
            'icon' => 'bi bi-check2-circle'
        ]);

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
        $this->authorize('view', Apartment::class);
        return view('resources.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $this->authorize('update', $apartment);
        $building = $apartment->building;
        return view('resources.apartments.form', compact('apartment', 'building'));
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
        $this->authorize('update', $apartment);

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

        session()->push('messages', [
            'text' => 'Datos actualizados satisfactoriamente.',
            'color' => 'success',
            'icon' => 'bi bi-hand-thumbs-up'
        ]);

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
        $this->authorize('delete', $apartment);

        $apartment->delete();

        session()->push('messages', [
            'text' => 'Departamento eliminado',
            'color' => 'warning',
            'icon' => 'bi bi-exclamation-circle'
        ]);

        return redirect('/buildings/' . $apartment->building_id);
    }
}
