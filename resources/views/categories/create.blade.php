@extends('layout.template')

@section('title')
    <title>Lubricentro | Categoría</title>
@endsection

@section('content')
    <h1>Registrar Categoría</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">Categoría</label>
            <input type="text" class="form-control" name="name">
        </div>
        <button type="input" class="btn btn-success">Guardar</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
@endsection
