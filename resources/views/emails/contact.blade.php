<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mensaje</title>
</head>
<body>
    <p>Se a realizado una nueva cotización desde el sitio web con la siguiente información: </p>
    {!! $informacion !!}
    <p> ¿Cuentas con un área libre de 1.5 mts de ancho por 2 mts de profundidad para la instalación del equipo? <b> {{ $pregunta_uno }} </b> </p>
    <p> ¿El área de circulación permite el tránsito y maniobra de unidades de hasta 6 mts de altura? <b> {{ $pregunta_dos }} </b> </p> 
    <p> ¿El acceso al sitio de recolección tiene un ancho de por lo menos 4.5 mts? <b> {{ $pregunta_tres }} </b> </p>
    <p> Generas algunos de los siguientes residuos: Escombro, Pintura, Solventes, Residuos peligrosos, madera, llantas, líquidos o Vidrio. <b> {{ $pregunta_cuatro }} </b> </p>
    <p> Razon Social: <b>{{$razon_social}}</b> </p>
    <p> Ciudad Servicio: <b>{{$ciudad_servicio}}</b> </p>
    <p> RFC: <b>{{$rfc}}</b> </p>
    <p> Tipo de contribuyente: <b>{{$tipo_contribuyente}}</b> </p>
    <p> Calle: <b>{{$calle}}</b> </p>
    <p> Numero: <b>{{$numero}}</b> </p>
    <p> Codigo Postal: <b>{{$codigo_postal}}</b> </p>
    <p> Colonia: <b>{{$colonia}}</b> </p>
    <p> Ciudad: <b>{{$ciudad}}</b> </p>
    <p> Nombre: <b>{{$nombre}}</b> </p>
    <p> Apellido Paterno: <b>{{$apellido_paterno}}</b> </p>
    <p> Apellido Materno: <b>{{$apellido_materno}}</b> </p>
    <p> E-mail: <b>{{$email}}</b> </p>
    <p> Telefono: <b>{{$telefono}}</b> </p>
    <p> Direccion de Google Maps: <b>{{$direccion_map}}</b> </p>
    <p> Comentarios adicionales: <b>{{$comentarios}}</b> </p>
</body>
</html>