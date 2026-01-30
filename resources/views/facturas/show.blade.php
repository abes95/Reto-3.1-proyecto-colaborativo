@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Factura #{{ $factura->id }} - {{ $factura->numero }}</h2>
        <div>
            <a href="{{ url('/facturas') }}" class="btn btn-secondary">Volver a facturas</a>
            <a href="{{ url('/facturas/' . $factura->id . '/edit') }}" class="btn btn-primary">Editar factura</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Fecha:</strong> {{ $factura->fecha }}</p>
            <p><strong>Cliente:</strong> {{ $factura->cliente->nombre ?? '' }}</p>
            <p class="mb-0"><strong>Base:</strong> {{ number_format($factura->base ?? 0, 2) }} &nbsp; <strong>IVA:</strong> {{ number_format($factura->importeiva ?? 0, 2) }} &nbsp; <strong>Importe:</strong> {{ number_format($factura->importe ?? 0, 2) }}</p>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-2">
        <h4 class="mb-0">Líneas</h4>
        <a href="{{ route('facturas.lineas.create', $factura->id) }}" class="btn btn-sm btn-primary">Nueva línea</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th class="text-end">Precio</th>
                    <th class="text-end">Base</th>
                    <th class="text-end">IVA (%)</th>
                    <th class="text-end">Importe IVA</th>
                    <th class="text-end">Importe</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($factura->lineas as $l)
                    <tr>
                        <td>{{ $l->id }}</td>
                        <td>{{ $l->codigo }}</td>
                        <td>{{ $l->cantidad }}</td>
                        <td>{{ $l->descripcion }}</td>
                        <td class="text-end">{{ number_format($l->precio, 2) }}</td>
                        <td class="text-end">{{ number_format($l->base, 2) }}</td>
                        <td class="text-end">{{ number_format($l->iva, 2) }}</td>
                        <td class="text-end">{{ number_format($l->importeiva, 2) }}</td>
                        <td class="text-end">{{ number_format($l->importe, 2) }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary" href="{{ url('/facturalineas/' . $l->id . '/edit') }}">Editar</a>
                            <form action="{{ url('/facturalineas/' . $l->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Borrar línea?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10">Sin líneas</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
