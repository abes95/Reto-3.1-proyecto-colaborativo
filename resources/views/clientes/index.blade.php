@extends('layouts.app')

@section('content')
<div class="container">

    @if (Session::has('mensaje'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ Session::get('mensaje') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-8">
            <form action="{{ route('clientes.index') }}" method="GET" class="d-flex">
                <input type="text" class="form-control me-2" name="buscar" value="{{ $buscar ?? '' }}" placeholder="Buscar...">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
    </div>

    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Logo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->direccion }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>
                        @if (!empty($cliente->logo) && \Illuminate\Support\Facades\Storage::disk('public')->exists($cliente->logo))
                            <img src="{{ asset('storage/' . $cliente->logo) }}" class="img-thumbnail img-fluid" style="max-width: 60px; max-height: 60px; object-fit: contain;">
                        @else
                            <img src="https://via.placeholder.com/60x60?text=No+Img" class="img-thumbnail img-fluid" style="max-width: 60px; max-height: 60px; object-fit: contain;">
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/clientes/' . $cliente->id . '/edit') }}" class="btn btn-success btn-sm">Editar</a>

                        <form action="{{ url('/clientes/' . $cliente->id) }}" method="POST" style="display:inline-block; margin:0 8px;">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Quiere borrar el cliente seleccionado?')">Borrar</button>
                        </form>

                        <a href="{{ url('/facturas/cliente/' . $cliente->id) }}" class="btn btn-primary btn-sm">Facturas</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7">
                    <a href="{{ url('clientes/create') }}" class="btn btn-primary">Nuevo</a>
                </td>
            </tr>
        </tfoot>
    </table>

    {!! $clientes->links() !!}

</div>
@endsection
