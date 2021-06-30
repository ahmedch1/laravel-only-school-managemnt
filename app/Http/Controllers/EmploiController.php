<?php

namespace App\Http\Controllers;

use App\Emploi;
use Illuminate\Http\Request;

class EmploiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emplois = Emploi::latest()->paginate(5);
        return view('backend.emplois.index', compact('emplois'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.emplois.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required',
            'link' => 'required',
            'description' => 'required']);
        Emploi::create($request->all());
        return redirect()->route('emplois.index')
            ->with('success', 'Emploi created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Emploi $emploi)
    {
        return view('backend.emplois.show', compact('emploi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Emploi $emploi)
    {
        return view('backend.emplois.edit', compact('emploi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emploi $emploi)
    {
        $request->validate(['name' => 'required',
            'link' => 'required',
            'description' => 'required']);
        $emploi->update($request->all());

        return redirect()->route('emplois.index')
            ->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emploi $emploi)
    {
        $emploi->delete();
        return redirect()->route('emplois.index')
            ->with('success', 'Emploi deleted successfully');
    }
}
