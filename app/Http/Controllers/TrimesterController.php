<?php

namespace App\Http\Controllers;


use App\Trim;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TrimesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trims = Trim::latest()->paginate(5);
        return view('backend.trims.index', compact('trims'));

        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexparent()
    {
        $trims = Trim::latest()->paginate(5);
        return view('backend.trims.indexparent', compact('trims'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.trims.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'file|nullable',
            'description' => 'required'
        ]);

        $trim = new Trim();
        $trim->name = $request->input('name');

        $trim->description = $request->input('description');
        if ($request->hasFile('link')) {
            $file = Str::slug($trim->name) . '-' . $trim->id . '.' . $request->link->getClientOriginalExtension();
            $request->link->move(public_path('Files/ProgramTrim'), $file);
        } else {
            $file = NULL;
        }

        $trim->link = $file;
        $trim->save();

        return redirect()->route('trims.index')
            ->with('success', 'Trimester Program created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Trim $trim)
    {
        return view('backend.trims.show', compact('trim'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Trim $trim)
    {
        return view('backend.trims.edit', compact('trim'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trim $trim)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'file|nullable',
            'description' => 'required'
        ]);

        $trim->name = $request->input('name');
        $trim->description = $request->input('description');

        if ($request->hasFile('link')) {
            $file = Str::slug($trim->name) . '-' . $trim->id . '.' . $request->link->getClientOriginalExtension();
            $request->link->move(public_path('Files/ProgramTrim'), $file);
        }
        if($request->hasFile('link')){
            $trim->link = $file;
        }
        $trim->save();

        return redirect()->route('trims.index')
            ->with('success', 'Trimester Program updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trim $trim)
    {
        $trim->delete();
        return redirect()->route('trims.index')
            ->with('success', 'Trimester Program deleted successfully');
    }
}
