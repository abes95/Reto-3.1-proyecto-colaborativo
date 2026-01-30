<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Líneas de factura</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{padding:20px}</style>
</head>
<body>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Líneas factura #{{ $factura->id }} - {{ $factura->numero ?? '' }}</h2>
        <div>
            <a class="btn btn-secondary" href="{{ url('/facturas') }}">Volver a facturas</a>
            <a class="btn btn-primary" href="{{ route('facturas.lineas.create', $factura->id) }}">Nueva línea</a>
        </div>
    </div>

    <div class="table-responsive">
    <table class="table table-striped table-bordered" style="width:100%; margin-top:10px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Base</th>
                <th>IVA</th>
                <th>Importe IVA</th>
                <th>Importe</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lineas as $l)
                <tr>
                    <td>{{ $l->id }}</td>
                    <td>{{ $l->codigo }}</td>
                    <td>{{ $l->cantidad }}</td>
                    <td>{{ $l->descripcion }}</td>
                    <td>{{ $l->precio }}</td>
                    <td>{{ $l->base }}</td>
                    <td>{{ $l->iva }}</td>
                    <td>{{ $l->importeiva }}</td>
                    <td>{{ $l->importe }}</td>
                    <td>
                        <a class="btn btn-sm btn-outline-primary me-1" href="{{ url('/facturalineas/' . $l->id . '/edit') }}">Editar</a>
                        <form action="{{ url('/facturalineas/' . $l->id) }}" method="POST" style="display:inline">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button class="btn btn-sm btn-outline-danger" type="submit" onclick="return confirm('Borrar línea?')">Borrar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="10">Sin líneas</td></tr>
            @endforelse
        </tbody>
    </table>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <div>
            <strong>Totales factura:</strong>
            <span class="ms-2">Base: {{ number_format($factura->base ?? 0, 2) }}</span>
            <span class="ms-2">IVA: {{ number_format($factura->importeiva ?? 0, 2) }}</span>
            <span class="ms-2">Importe: {{ number_format($factura->importe ?? 0, 2) }}</span>
        </div>
        <div>
            {{ $lineas->links() }}
        </div>
    </div>
</body>
</html>
