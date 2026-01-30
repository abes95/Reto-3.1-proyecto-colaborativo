<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar un cliente</title>
</head>
<body>
    @extends('layouts.app')
    @section('content')

<br><br>
<div class="container">
<form action="{{ url('/clientes/' . $cliente->id) }}" method="post" enctype="multipart/form-data">
    
    @csrf
    {{ method_field('PATCH') }}

    @include('clientes.form',['submit' => 'Modificar cliente', 'cancel' => 'Cancelar la modificación'])
</form>
</div>
@endsection 
</body>
</html>

