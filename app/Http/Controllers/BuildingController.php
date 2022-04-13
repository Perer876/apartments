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
    public function index(Request $request)
    {
        return view('resources.buildings.index', [
            'buildings' => Building::all(),
            'view' => $request->query('view') ?? 'cards',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $form_rules = [
            'alias' => ['required','max:255','unique:App\Models\Building'],
            'street' => 'required|max:255',
            'number' => 'required|integer|min:0|max:999999',
            'postcode' => 'required|integer|min:1|max:99999',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'builded_at' => 'nullable|integer|min:1902|max:2022'
        ];

        $request->validate($form_rules);
        
        Building::create($request->all());
        
        return redirect('/buildings');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Building $building)
    {
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
        $form_rules = [
            'alias' => ['required','max:255', Rule::unique('buildings')->ignore($building->id),],
            'street' => 'required|max:255',
            'number' => 'required|integer|min:0|max:999999',
            'postcode' => 'required|integer|min:1|max:99999',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'builded_at' => 'nullable|integer|min:1902|max:2022',
        ];

        $request->validate($form_rules);
        
        Building::where('id', $building->id)->update($request->except(['_method', '_token']));

        return redirect('/buildings/'.$building->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->delete();

        return redirect('/buildings');
    }
}
