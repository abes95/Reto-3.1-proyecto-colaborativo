@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Editar factura #{{ $factura->id }}</h2>
    </div>

    <form action="{{ url('/facturas/'. $factura->id) }}" method="POST">
        @csrf
        {{ method_field('PATCH') }}

        @include('facturas.form', ['submit'=> 'Modificar factura', 'cancelar' => 'Cancelar la modificación'])
    </form>
</div>
@endsection