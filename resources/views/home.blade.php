@extends('layouts.app')

@section('content')
<div class="container">
    <nav class="nav nav-pills nav-fill">
        <a class="nav-link active" aria-current="page" href="{{route('home')}}">Usuarios</a>
        <a class="nav-link " href="{{route('index_curso_usuario')}}">Asignar cursos</a>
        <a class="nav-link " href="{{route('indexcourses')}}">Cursos</a>

      </nav>
    <usuario/>
</div>
@endsection
