<?php

namespace App\Http\Controllers;

use App\Actualite;
use Illuminate\Http\Request;

class ActualiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actualite = Actualite::latest()->paginate(10);

        return view('backend.actualite.index', compact('actualite'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $actualite = Actualite::latest()->paginate(10);
        return view('backend.actualite.create', compact('actualite'));
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
            'name' => 'required|string|max:255|unique:subjects',
            'description' => 'required|string|max:255',
            'slug'=>'string'
        ]);

        Actualite::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug'=>'ddd',
            'actualite_code'=>'3'
        ]);

        return redirect()->route('actualite.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Actualite $actualite
     * @return \Illuminate\Http\Response
     */
    public function show(Actualite $actualite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Actualite $actualite
     * @return \Illuminate\Http\Response
     */
    public function edit(Actualite $actualite)
    {
        $actualite = Actualite::latest()->get();

        return view('backend.actualite.edit', compact('actualite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Actualite $actualite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actualite $actualite)
    {
        $request->validate([
            'name'          => 'required|string|max:255|unique:subjects,name,'.$actualite->id,
            'subject_code'  => 'required|numeric',
            'teacher_id'    => 'required|numeric',
            'description'   => 'required|string|max:255'
        ]);

        $actualite->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'subject_code'  => $request->subject_code,
            'teacher_id'    => $request->teacher_id,
            'description'   => $request->description
        ]);

        return redirect()->route('actualite.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Actualite $actualite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Actualite $actualite)
    {
        $actualite->delete();

        return back();
    }
}
