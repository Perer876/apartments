<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Building::class);
        return view('resources.buildings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Building::class);
        return view('resources.buildings.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Building::class);

        $form_rules = [
            'alias' => ['required','max:255','unique:App\Models\Building'],
            'street' => 'required|max:255',
            'number' => 'required|integer|min:0|max:999999',
            'postcode' => 'required|integer|min:1|max:99999',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'builded_at' => 'nullable|integer|min:1902|max:2022'
        ];

        $validated = $request->validate($form_rules);
        $validated['user_id'] = $request->user()->id;
        
        Building::create($validated);

        session()->push('messages', [
            'text' => 'Edificio agregado correctamente.',
            'icon' => 'bi bi-check2-circle'
        ]);
        
        return redirect()->route('buildings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
        $this->authorize('view', Building::class);
        return view('resources.buildings.show', compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        $this->authorize('update', $building);
        return view('resources.buildings.form', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        $this->authorize('update', $building);

        $form_rules = [
            'alias' => ['required','max:255', Rule::unique('buildings')->ignore($building->id),],
            'street' => 'required|max:255',
            'number' => 'required|integer|min:0|max:999999',
            'postcode' => 'required|integer|min:1|max:99999',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'builded_at' => 'nullable|integer|min:1902|max:2022',
        ];

        $validated = $request->validate($form_rules);
        
        Building::where('id', $building->id)->update($validated);

        session()->push('messages', [
            'text' => 'Datos actualizados satisfactoriamente.',
            'color' => 'success',
            'icon' => 'bi bi-hand-thumbs-up'
        ]);

        return redirect()->route('buildings.show', $building);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $this->authorize('delete', $building);

        $building->delete();

        session()->push('messages', [
            'text' => 'Edificio eliminado',
            'color' => 'warning',
            'icon' => 'bi-trash'
        ]);

        return redirect()->route('buildings.index');
    }
}
