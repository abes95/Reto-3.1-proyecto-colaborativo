@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Crear factura</h2>
    </div>

    <form action="{{ url('/facturas') }}" method="POST">
        @csrf
        @include('facturas.form', ['submit' => 'Crear factura', 'cancelar' => 'Cancelar creación'])
    </form>
</div>
@endsection