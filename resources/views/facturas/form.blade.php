<div class="mb-3">
    <label for="numero" class="form-label">Numero</label>
    <input type="text" name="numero" id="numero" maxlength="10" class="form-control"
        value="{{ isset($factura->numero) ? $factura->numero : old('numero') }}" @if(isset($readonly)) {{ $readonly }} @endif>
</div>

<div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input type="date" name="fecha" id="fecha" class="form-control"
        value="{{ isset($factura->fecha) ? $factura->fecha : old('fecha') }}" @if(isset($readonly)) {{ $readonly }} @endif>
</div>

<div class="mb-3">
    <label for="cliente" class="form-label">Cliente</label>
    <select name="cliente_id" id="cliente_id" class="form-control">
        @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}" @if(isset($factura->cliente_id) && ($cliente->id == $factura->cliente_id)) selected="selected" @endif>{{ $cliente->nombre }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="base" class="form-label">Base</label>
    <input type="number" step="0.01" name="base" id="base" class="form-control"
        value="{{ isset($factura->base) ? $factura->base : old('base') }}" @if(isset($readonly)) {{ $readonly }} @endif>
</div>

<div class="mb-3">
    <label for="importeiva" class="form-label">Importe I.V.A.</label>
    <input type="number" step="0.01" name="importeiva" id="importeiva" class="form-control"
        value="{{ isset($factura->importeiva) ? $factura->importeiva : old('importeiva') }}" @if(isset($readonly)) {{ $readonly }} @endif>
</div>

<div class="mb-3">
    <label for="importe" class="form-label">Importe</label>
    <input type="number" step="0.01" name="importe" id="importe" class="form-control"
        value="{{ isset($factura->importe) ? $factura->importe : old('importe') }}" @if(isset($readonly)) {{ $readonly }} @endif>
</div>

<div class="d-flex gap-2">
    @if(isset($submit))
        <button type="submit" class="btn btn-primary">{{ $submit }}</button>
    @endif

    @php $btnCancelar = $cancelar ?? 'Cancelar'; @endphp
    <a href="{{ url('/facturas/') }}" class="btn btn-danger">{{ $btnCancelar }}</a>
</div>