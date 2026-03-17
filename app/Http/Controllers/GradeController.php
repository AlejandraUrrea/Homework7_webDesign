<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $subjects = Subject::all();
    $selectedSubject = null;
    $grades = [];

    if ($request->has('subject_id') && $request->subject_id != "") {
        $selectedSubject = Subject::findOrFail($request->subject_id);
        $grades = Grade::where('subject_id', $request->subject_id)->get();
    }

    // Asegúrate de que esta línea exista:
    return view('grades.index', compact('subjects', 'selectedSubject', 'grades'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // 1. Validamos los datos (asegúrate de que los nombres coincidan con el HTML)
    $request->validate([
        'subject_id'    => 'required',
        'activity_type' => 'required|string|max:255',
        'score'         => 'required|numeric',
        'date'          => 'required|date',
        'comments'      => 'nullable|string'
    ]);

    // 2. Creamos el registro
    Grade::create([
        'subject_id'    => $request->subject_id,
        'activity_type' => $request->activity_type,
        'score'         => $request->score,
        'date'          => $request->date,
        'comments'      => $request->comments,
    ]);

    // 3. Redireccionamos de vuelta con la materia seleccionada
    return redirect()->route('grades.index', ['subject_id' => $request->subject_id])
                     ->with('success', 'Calificación guardada');
}

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }
}
