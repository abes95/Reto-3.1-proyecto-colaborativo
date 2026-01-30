<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear usuario</title>
</head>
<body>

    @extends('layouts.app')
    @section('content')
    <div class="container">

<h1>Insertar cliente</h1>

<br><br>
<form action="{{ url('/clientes') }}" method="post" enctype="multipart/form-data">
    @csrf

   @include('clientes.form',['submit' => 'Añadir cliente', 'cancel' => 'Cancelar la inserción'])

    
</form>

</div>
@endsection 
</body>
</html>





