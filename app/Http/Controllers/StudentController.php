<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Course;
use App\Models\Department;
use App\Models\Municipality;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $countries = Country::all();
        $departaments = Department::all();
        $municipalities = Municipality::all();
        $trainee = Student::all();
        return view('students.index', compact('trainee', 'courses', 'countries', 'departaments', 'municipalities'));
       // return $trainee;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $countries = Country::all();
        $departaments = Department::all();
        $municipalities = Municipality::all();
        $trainee = Student::all();
        return view('students.create', compact('trainee', 'courses', 'countries', 'departaments', 'municipalities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $trainee = new Student();
        $trainee->document_type = $request->input('document_type');
        $trainee->document_number = $request->input('document_number');
        if($request->hasFile('identify_document')){
            $trainee->identify_document = $request->file('identify_document')->store('public/students/identify_document');
        }
        $trainee->id_issuing_municipality = $request->input('id_issuing_municipality');
        $trainee->expedition_date = $request->input('expedition_date');
        $trainee->name = $request->input('names');
        $trainee->first_last_name = $request->input('first_last_name');
        $trainee->second_last_name = $request->input('second_last_name');
        $trainee->gender = $request->input('gender');
        $trainee->birth_date = $request->input('birth_date');
        $trainee->id_birth_municipality = $request->input('id_birth_municipality');
        $trainee->stratum = $request->input('stratum');
        $trainee->id_course = $request->input('id_course');
        $trainee->save();
        return view('students.add_student');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trainee = Student::find($id);
        return view('students.show' , compact('trainee'));
        //return 'El id del estudiente es: ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trainee = Student::find($id);
        //return 'El id del estudiente es: ' . $id;
        //return 'La informacion que usted quiere autualizar, se veria en formato array...' . $trainee;
        return view('students.edit', compact('trainee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trainee = Student::find($id);
        // return $trainee;
        $trainee->fill($request->except('identify_document'));
        if($request->hasFile('identify_document')){
            $trainee->identify_document = $request->file('identify_document')->store('public/students/identify_document');
        }
        $trainee->save();
        return view('students.add_student');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trainee = Student::find($id);
        $urlDocument = $trainee->identify_document;
        $documentName = str_replace('public/', '\storage\\', $urlDocument);
        $fullRoute = public_path() . $documentName;
        unlink($fullRoute);
        $$trainee->delete();
        return view('students.del_student');
    }
}
