<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('students/index', ['students' => $students]);
        // kalau fungsinya sama bisa pake kaya berikut:(samaaj)
        // return view('student/index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('students/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // cara 1:
        // $student = new Student;
        // $student->nama = $request->nama;
        // $student->nim = $request->nim;
        // $student->email = $request->email;
        // $student->jurusan = $request->jurusan;
        // $student->save();
        // return redirect('/students');

        // cara 2 (pake create)
        // panggil modelnya, lalu create (teks dibawah ini) 
        // Student::create([
        //     'nama' => $request->nama,
        //     'nim' => $request->nim,
        //     'email' => $request->email,
        //     'jurusan' => $request->jurusan
        // ]);

        //sebelum masukin data (request) ke DB, maka cek dlu/ validate dulu
        // $request->validate([
        //     'nama' => 'required',
        //     'nim' => 'required',
        //     'jurusan' => 'required'
        // ]);
        $request->validate(
            [
                'nama' => 'required',
                'nim' => 'required',
                'email' => 'required|unique:students,email|email',
                'jurusan' => 'required',

            ],
            [
                'nama.required' => 'Nama harus diisi',
                'nim.required' => 'NIM Harus diisi',
                // 'nrp.size'=>'nim berjumlah 9 digit',
                'email.required' => 'Email Harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'jurusan.required' => 'Apa jurusannya?'

            ]

        );
        //cara 3 (msh sama kya cara 2, tapi harus edit models/student.php (harus ada $fillable/ $guarded cari di dok laravel klo lupa) sbenernya buat simple aja sih, sama aja kya cara 2)
        //all nya hanya akan ngambil yg ada didalam $fillable/ diluar $guarded
        Student::create($request->all());
        return redirect('/students')->with('status', 'Data mahasiswa berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
        //compactnya bisa ['student'] => $student=student kalau gasalah (cek lg ini hehe)
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('students/edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate(
            [
                'nama' => 'required',
                'nim' => 'required',
                'email' => 'required|email',
                'jurusan' => 'required',

            ],
            [
                'nama.required' => 'Nama harus diisi',
                'nim.required' => 'NIM Harus diisi',
                // 'nrp.size'=>'nim berjumlah 9 digit',
                'email.required' => 'Email Harus diisi',
                'email.email' => 'Email tidak valid',
                'jurusan.required' => 'Apa jurusannya?'

            ]
        );

        Student::where('id', $student->id)
            ->update([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan
            ]);
        return redirect('/students')->with('status', 'Data mahasiswa berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        Student::destroy($student->id);
        return redirect('/students')->with('status', 'Data mahasiswa berhasil dihapus!');
    }
}
