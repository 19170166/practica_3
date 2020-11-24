<!DOCTYPE html>
<html>
<head>
	<title>Verifica tu correo</title>
</head>
<body>
<h1>Bienvenido!!</h1>
<p>Hola, <b>{{$usu->nombre}}</b> te has registrado con el correo <b>{{$usu->correo}}</b> para
verificar tu correo use el siguiente enlace</p>
<b>http://127.0.0.1:8000/api/actualizar/cuenta/{{$usu->id}}</b>
</body>
</html>