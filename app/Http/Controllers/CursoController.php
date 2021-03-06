<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Curso;
use App\Nivel;
use App\Grado;
use App\Seccion;

class CursoController extends Controller
{
    const PAGINACION = 4;
    public function index(Request $request)
    {
        $buscarpor = $request->buscarpor;
        $niveles=Nivel::all();
        $cursos = Curso::where('estado','=','1')->where('curso','like','%'.$buscarpor.'%')->paginate($this::PAGINACION);
        return view('cursos.index',compact('cursos','niveles','buscarpor'));
    }

    public function create()
    {
        $niveles = Nivel::all();
        $grados = Grado::all();
        return view('cursos.create',compact('niveles','grados'));
    }

    public function store(Request $request)
    {
        $data=request()->validate([
            'CODIGO'=>'required|max:2',
            'CURSO'=>'required|max:30',
            'IDNIVEL'=>'required',
            'IDGRADO'=>'required',
        ],
        [
            'CODIGO.required'=>'Ingrese código del curso',
            'CODIGO.max'=>'Maximo 2 caracteres para el código del curso',
            'CURSO.required'=>'Ingrese descripcion del curso',
            'CURSO.max'=>'Maximo 30 caracteres para la descripcion del curso',
            'IDNIVEL.required'=>'Seleccione un nivel para el curso',
            'IDGRADO.required'=>'Seleccione un grado para el curso',
        ]);
        $curso=new Curso();
        $curso->CODIGO=$request->CODIGO;
        $curso->CURSO=$request->CURSO;
        $curso->IDNIVEL=$request->IDNIVEL;
        $curso->IDGRADO=$request->IDGRADO;
        $curso->IDSECCION=$request->IDSECCION;
        $curso->estado='1';
        $curso->save();
        return redirect()->route('curso.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $curso = Curso::findOrFail($id);
        $niveles = Nivel::all();
        $grados = Grado::where('IDNIVEL','=',$curso->IDNIVEL)->get();
        $secciones = Seccion::where('IDGRADO','=',$curso->IDSECCION)->get();
        return view('cursos.edit',compact('curso','niveles','grados','secciones'));
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'CODIGO'=>'required|max:2',
            'CURSO'=>'required|max:30',
            'IDNIVEL'=>'required',
            'IDGRADO'=>'required',
        ],
        [
            'CODIGO.required'=>'Ingrese codigo del curso',
            'CODIGO.max'=>'Maximo 2 caracteres para el codigo del curso',
            'CURSO.required'=>'Ingrese descripcion del curso',
            'CURSO.max'=>'Maximo 30 caracteres para la descripcion del curso',
            'IDNIVEL.required'=>'Seleccione un nivel para el curso',
            'IDGRADO.required'=>'Seleccione un grado para el curso',
        ]);
        Curso::findOrFail($id)->update($request->all());
        return redirect()->route('curso.index')->with('datos','Registro Actualizado ... !');
    }

    public function confirmar($id){
        $niveles = Nivel::all();
        $curso=Curso::findOrFail($id);
        return view('cursos.confirmar',compact('curso','niveles'));
    }

    public function destroy($id)
    {
        $curso=Curso::findOrFail($id);
        $curso->estado='0';
        $curso->save();
        return redirect()->route('curso.index')->with('datos','Registro Eliminado ... !');
    }
}
