<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Docente;
use App\Nivel;
use App\Grado;

class DocenteController extends Controller
{
    const PAGINACION = 4;
    public function index(Request $request)
    {
        $buscarpor = $request->buscarpor;
        $niveles=Nivel::all();
        $grados=Grado::all();
        $docentes=Docente::where('estado','=','1')->where('APENOM','like','%'.$buscarpor.'%')->paginate($this::PAGINACION);
        return view('docentes.index',compact('docentes','niveles','grados','buscarpor'));
    }

    public function create()
    {
        $niveles = Nivel::all();
        $grados = Grado::all();
        return view('docentes.create',compact('niveles','grados'));
    }

    public function store(Request $request)
    {
        $data=request()->validate([
            'APENOM'=>'required|max:60',
            'DNI'=>'required|max:8',
            'DIRECCION'=>'required|max:60',
            'ESTADOCIVIL'=>'required',
            'TELEFONO'=>'required|max:9',
            'SEGUROSOCIAL'=>'required|max:60',
            'FECINGRESO'=>'required',
        ],
        [
            'APENOM.required'=>'Ingrese apellidos y nombres del docente',
            'APENOM.max'=>'Maximo 60 caracteres para los apellidos y nombres del docente',
            'DNI.required'=>'Ingrese DNI del docente',
            'DNI.max'=>'Maximo 8 caracteres para el DNI del docente',
            'DIRECCION.required'=>'Ingrese dirección del docente',
            'DIRECCION.max'=>'Maximo 60 caracteres para la dirección del docente',
            'ESTADOCIVIL.required'=>'Especifique su estado civil',
            'TELEFONO.required'=>'Ingrese telefono del docente',
            'TELEFONO.max'=>'Maximo 9 caracteres para el telefono del docente',
            'SEGUROSOCIAL.required'=>'Ingrese seguro social del docente',
            'SEGUROSOCIAL.max'=>'Maximo 50 caracteres para el seguro social del docente',
            'FECINGRESO.required'=>'Ingrese fecha de ingreso',
        ]);
        $docente=new Docente();
        $docente->APENOM=$request->APENOM;
        $docente->DNI=$request->DNI;
        $docente->DIRECCION=$request->DIRECCION;
        $docente->TELEFONO=$request->TELEFONO;
        $docente->ESTADOCIVIL=$request->ESTADOCIVIL;
        $docente->SEGUROSOCIAL=$request->SEGUROSOCIAL;
        $docente->FECINGRESO=$request->FECINGRESO;
        $docente->estado='1';
        $docente->save();
        return redirect()->route('docente.index')->with('datos','Registro Nuevo Guardado ...!');
    }

    public function show($id)
    {
        return Docente::find($id);
    }

    public function edit($id)
    {
        $docente=Docente::findOrFail($id);
        $niveles = Nivel::all();
        $grados = Grado::all();
        return view('docentes.edit',compact('docente','niveles','grados'));
    }

    public function update(Request $request, $id)
    {
        $data=request()->validate([
            'APENOM'=>'required|max:60',
            'DNI'=>'required|max:8',
            'DIRECCION'=>'required|max:60',
            'TELEFONO'=>'required|max:9',
            'SEGUROSOCIAL'=>'required|max:60',
            'FECINGRESO'=>'required',
        ],
        [
            'APENOM.required'=>'Ingrese apellidos y nombres del docente',
            'APENOM.max'=>'Maximo 60 caracteres para los apellidos y nombres del docente',
            'DNI.required'=>'Ingrese DNI del docente',
            'DNI.max'=>'Maximo 8 caracteres para el DNI del docente',
            'DIRECCION.required'=>'Ingrese dirección del docente',
            'DIRECCION.max'=>'Maximo 60 caracteres para la dirección del docente',
            'TELEFONO.required'=>'Ingrese telefono del docente',
            'TELEFONO.max'=>'Maximo 9 caracteres para el telefono del docente',
            'SEGUROSOCIAL.required'=>'Ingrese seguro social del docente',
            'SEGUROSOCIAL.max'=>'Maximo 60 caracteres para el seguro social del docente',
            'FECINGRESO.required'=>'Ingrese fecha de ingreso',
        ]);
        Docente::findOrFail($id)->update($request->all());
        return redirect()->route('docente.index')->with('datos','Registro Actualizado ... !');
    }

    public function confirmar($id){
        $niveles = Nivel::all();
        $grado = Grado::all();
        $docente=Docente::findOrFail($id);
        return view('docentes.confirmar',compact('docente','niveles','grado'));
    }

    public function destroy($id)
    {
        $docente=Docente::findOrFail($id);
        $docente->estado='0';
        $docente->save();
        return redirect()->route('docente.index')->with('datos','Registro Eliminado ... !');
    }
}
