@extends('layouts.main')
@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Crear producto
                        <a href="" class="btn btn-success btn-sm float-right">Nuevo producto</a>
                    </div>
                    <div class="card-body">
                        <form action=" {{route('products.store')}} " method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Descripción</label>
                                <input type="text" class="form-control" name="description"/>
                            </div>
                            <div class="form-group">
                                <label for="">Precio</label>
                                <input type="number" class="form-control" name="price"/>
                            </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <a href="{{ route('products.index') }}" class="btn btn-danger">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection