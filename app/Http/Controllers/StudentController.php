<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;
class StudentController extends Controller
{
/**
* Display a listing of the resource.
*/
public function index()
{
// Memanggil seluruh data dari table Student
$students = Student::all();
return view('student.index', ['students' => $students ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::where(['nim' => $id]);
        if ($student->count() <1) {
            return redirect('/student')->with([
                'notifikasi' => 'Data siswa tidak ditemukan !',
                'type' => 'error'
            ]);
        }

        return view('student.edit', ['student' => $student->first() ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
