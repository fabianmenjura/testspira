<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('home');
    }
    public function indexCourses(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('courses');
    }
    public function curso_usuarios(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        return view('curso_usuarios');
    }
    
    public function index_curso_usuario(Request $request)
    {
        $request->user()->authorizeRoles(['admin','alumno']);
        return view('curso_usuario');
    }
}
