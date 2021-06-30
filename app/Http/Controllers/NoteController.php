<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::latest()->paginate(5);
        return view('backend.notes.index', compact('notes'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.notes.create');
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
            'title' => 'required',
            'name' => 'required',
            'rate' => 'required',
            'description' => 'required'
        ]);
        Note::create($request->all());
        return redirect()->route('notes.index')
            ->with('success', 'Note created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        return view('backend.notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('backend.notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'rate' => 'required',
            'description' => 'required'
        ]);
        $note->update($request->all());

        return redirect()->route('notes.index')
            ->with('success', 'Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')
            ->with('success', 'Note deleted successfully');
    }
}
