<?php

namespace App\Http\Controllers;


use App\Hebdo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HebdomadaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hebdos = Hebdo::latest()->paginate(5);
        return view('backend.hebdos.index', compact('hebdos'));

        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexparent()
    {
        $hebdos = Hebdo::latest()->paginate(5);
        return view('backend.hebdos.indexparent', compact('hebdos'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.hebdos.create');
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

        $hebdo = new Hebdo();
        $hebdo->name = $request->input('name');

        $hebdo->description = $request->input('description');
        if ($request->hasFile('link')) {
            $file = Str::slug($hebdo->name) . '-' . $hebdo->id . '.' . $request->link->getClientOriginalExtension();
            $request->link->move(public_path('Files/ProgramTrim'), $file);
        } else {
            $file = NULL;
        }

        $hebdo->link = $file;
        $hebdo->save();

        return redirect()->route('hebdos.index')
            ->with('success', 'Weekly Program created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Hebdo $hebdo)
    {
        return view('backend.hebdos.show', compact('hebdo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Hebdo $trim)
    {
        return view('backend.hebdos.edit', compact('hebdo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hebdo $hebdo)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'file|nullable',
            'description' => 'required'
        ]);

        $hebdo->name = $request->input('name');
        $hebdo->description = $request->input('description');

        if ($request->hasFile('link')) {
            $file = Str::slug($hebdo->name) . '-' . $hebdo->id . '.' . $request->link->getClientOriginalExtension();
            $request->link->move(public_path('Files/ProgramTrim'), $file);
        }
        if($request->hasFile('link')){
            $hebdo->link = $file;
        }
        $hebdo->save();

        return redirect()->route('hebdos.index')
            ->with('success', 'Weekly Program updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hebdo $hebdo)
    {
        $hebdo->delete();
        return redirect()->route('hebdos.index')
            ->with('success', 'Weekly Program deleted successfully');
    }
}
