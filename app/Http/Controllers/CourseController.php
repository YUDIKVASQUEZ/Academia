<?php

namespace App\Http\Controllers;

use App\Http\Requests\storePersonajeRequest;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grade = Course::all();//Traemos toda la info de la tabla courses a traves del modelo y el método all()
        return view('courses.index', compact('grade'));//Se adjunta grade a la vista para poderlo usar, usando compact
        // return $grade;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storePersonajeRequest $request)
    {
        //  se implementa Validacion
            // $dataValidate = $request->validate([
            //     'nombre' => 'required|max:10',
            //     'avatar' => 'required|image'
            // ]);
        //Se devuelve la petición hecha al servidor
        // return $request->all();
        $grade = new Course();//Crear una instancia de la clase Curso
        $grade->name = $request->input('name');
        $grade->description = $request->input('description');
        $grade->duration = $request->input('duration');
        if($request->hasFile('imagen')){
            $grade->imagen = $request->file('imagen')->store('public/courses');
        }
        $grade->save();//Comando para registrar la info en la bd
        return view('courses.add_course');
        // return $grade->description;
        // return $grade;
        // return $request->input('name');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $grade = Course::find($id);
        return view('courses.show', compact('grade'));
        // return 'El id de este curso es: ' . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $grade = Course::find($id);
        // return 'El id de este curso es: ' . $id;
        // return 'La iformación que ud quiere actualizar, se vería en formato array...' . $grade;
        return view('courses.edit', compact('grade'));
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
        $grade = Course::find($id);
        // return $grade;
        $grade->fill($request->except('imagen'));
        if($request->hasFile('imagen')){
            $grade->imagen = $request->file('imagen')->store('public/courses');
        }
        $grade->save();
        // return $request;
        return view('courses.update_course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $grade = Course::find($id);

        $urlImagenBD = $grade->imagen;
        // return $urlImagenBD;
        // $rutaCompleta = public_path().$urlImagenBD;
        // return $rutaCompleta;
        $nombreImagen = str_replace('public/', '\storage\\', $urlImagenBD );
        $rutaCompleta = public_path().$nombreImagen;
        // return $rutaCompleta;
        unlink($rutaCompleta);
        $grade ->delete();
        return \view('courses.del_course');

    }
}
