<!DOCTYPE html>
<html>
<head>
	<title>Alguien ha comentado en uno de tus productos</title>
</head>
<body>
<h1>Aviso!!</h1>
<p>El usuario <b>{{$usu->nombre}}</b> con el correo <b>{{$usu->correo}}</b> ha comentado
en su producto <b>{{$art->nombre_articulo}}</b> y dijo lo siguiente: <b>{{$com->comentario}}</b></p>
</body>
</html>