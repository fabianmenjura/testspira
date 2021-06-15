<?php

namespace App\Http\Controllers;

use App\Models\Curso_usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CursoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('curso_usuarios as cu')
            ->join('courses as c', 'cu.course_id', '=', 'c.id')
            ->join('usuarios as u', 'cu.usuario_id', '=', 'u.id')
            ->select('cu.course_id', 'cu.id', 'cu.usuario_id', 'u.name', 'u.last_name', 'c.name_course', 'c.intensidad')
            ->get();

        return $users;
        // return Curso_usuario::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curso_usuario = new Curso_usuario();
        $curso_usuario->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curso_usuario  $curso_usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Curso_usuario $curso_usuario)
    {
        return $curso_usuario;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curso_usuario  $curso_usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curso_usuario $curso_usuario)
    {
        $curso_usuario->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curso_usuario  $curso_usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curso_usuario $curso_usuario)
    {
        $curso_usuario->delete();
    }
}
