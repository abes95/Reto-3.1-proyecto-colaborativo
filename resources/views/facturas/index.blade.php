<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{padding:20px}</style>
 </head>
<body>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <a class="btn btn-secondary" href="{{ url('/clientes') }}">Volver a Clientes</a>
            <a class="btn btn-primary" href="{{ url('/facturas/create') }}">Nueva factura</a>
        </div>
        @if(isset($facturascliente) && isset($facturas) && count($facturas) > 0)
            <h5 class="mb-0">Facturas del cliente: {{ $facturas->first()->nombre ?? '' }}</h5>
        @endif
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Número</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th class="text-end">Base</th>
                <th class="text-end">Importe I.V.A.</th>
                <th class="text-end">Importe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($facturas) && count($facturas) > 0)
                @foreach($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->numero }}</td>
                        <td>{{ $factura->fecha }}</td>
                        @if (isset($facturascliente))
                            <td>{{ $factura->nombre }}</td>
                        @else
                            <td>{{ $factura->cliente->nombre ?? '' }}</td>
                        @endif
                        <td class="text-end">{{ number_format($factura->base ?? 0, 2) }}</td>
                        <td class="text-end">{{ number_format($factura->importeiva ?? 0, 2) }}</td>
                        <td class="text-end">{{ number_format($factura->importe ?? 0, 2) }}</td>
                        <td>
                            <a class="btn btn-sm btn-outline-primary me-1" href="{{ route('facturas.lineas', $factura->id) }}">Líneas</a>
                            <a class="btn btn-sm btn-outline-secondary me-1" href="{{ url('/facturas/' . $factura->id . '/edit') }}">Editar</a>
                            <form action="{{ url('/facturas/' . $factura->id) }}" method="POST" style="display:inline">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('¿Quiere borrar la factura seleccionada?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">Sin facturas</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div>
            @if(isset($totales))
                <strong>Totales cliente:</strong>
                <span class="ms-2">Base: {{ number_format($totales->base_sum ?? 0, 2) }}</span>
                <span class="ms-2">IVA: {{ number_format($totales->iva_sum ?? 0, 2) }}</span>
                <span class="ms-2">Importe: {{ number_format($totales->importe_sum ?? 0, 2) }}</span>
            @endif
        </div>
        <div>
            @if(method_exists($facturas, 'links'))
                {{ $facturas->links() }}
            @endif
        </div>
    </div>
</body>
</html>