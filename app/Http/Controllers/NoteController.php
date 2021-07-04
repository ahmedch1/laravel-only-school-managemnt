<?php

namespace App\Http\Controllers;

use App\Note;
use App\Parents;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $student = Student::where('parent_id' , '=', Auth::id())->get();
        return view('backend.notes.index', compact('notes', 'student'));

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $students = Student::latest()->get();
        return view('backend.notes.create', compact('students'));
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
            'user_id' => 'required',
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
            'user_id' => 'required',
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
