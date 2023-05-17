@extends('layout.template')

@section('title')
    <title>Lubricentro | Producto</title>
@endsection

@section('content')
    <h1>Editar Producto</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category_name">Categoría</label>
            <select class="form-control" name="category_id" required>
                <option value="">Seleccione ...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if ($category->id == $product->category_id) ? selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="category_name">Producto</label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
        </div>

        <div class="form-group">
            <label for="category_name">Stock</label>
            <input type="text" class="form-control" name="stock" value="{{ $product->stock }}">
        </div>

        <div class="form-group">
            <label for="category_name">Precio</label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
        </div>

        <button type="input" class="btn btn-success">Guardar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Regresar</a>
    </form>
@endsection
