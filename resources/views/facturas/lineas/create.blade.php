<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nueva línea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{padding:20px}</style>
</head>
<body>
    <div class="container">
        <h2>Nueva línea para factura #{{ $factura->id }}</h2>
        <a class="btn btn-link" href="{{ route('facturas.lineas', $factura->id) }}">Volver</a>

        <form action="{{ route('facturalineas.store') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="id_factura" value="{{ $factura->id }}">
            <div class="row">
                <div class="mb-3 col-md-2">
                    <label class="form-label">Código</label>
                    <input class="form-control" type="text" name="codigo">
                </div>
                <div class="mb-3 col-md-2">
                    <label class="form-label">Cantidad</label>
                    <input class="form-control" type="text" name="cantidad" value="1">
                </div>
                <div class="mb-3 col-md-4">
                    <label class="form-label">Descripción</label>
                    <input class="form-control" type="text" name="descripcion">
                </div>
                <div class="mb-3 col-md-2">
                    <label class="form-label">Precio</label>
                    <input class="form-control" type="text" name="precio" value="0.00">
                </div>
                <div class="mb-3 col-md-2">
                    <label class="form-label">IVA (%)</label>
                    <input class="form-control" type="text" name="iva" value="21.00">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
