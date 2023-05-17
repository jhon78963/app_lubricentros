@extends('layout.template')

@section('title')
    <title>Lubricentro | Producto</title>
@endsection

@section('content')
    <h1>Registrar Producto</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_name">Categoría</label>
            <select class="form-control" name="category_id" required>
                <option value="">Seleccione ...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_name">Producto</label>
            <input type="text" class="form-control" name="name">
        </div>

        <div class="form-group">
            <label for="category_name">Stock</label>
            <input type="text" class="form-control" name="stock">
        </div>

        <div class="form-group">
            <label for="category_name">Precio</label>
            <input type="text" class="form-control" name="price">
        </div>

        <button type="input" class="btn btn-success">Guardar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
@endsection
