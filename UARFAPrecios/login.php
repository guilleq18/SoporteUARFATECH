<?php
    session_start();
    if(isset($_SESSION['inventarioUser'])){
        session_destroy();
    }
?>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tu nombre</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
	<style>
		.form-signin{
			max-width: 330px;
			padding: 15px;
			margin: 0px auto;
		}
	</style>
</head>
<body>
	<div class="container">
	
<form class="form-signin" method="post" action="/php/inventario/usuarios.php">
		<input type="hidden" name="tipo" value="login">
        <h2 class="form-signin-heading">Entrada</h2>
        <label for="user" class="sr-only">Tu nombre</label>
        <input type="text" id="user" name="user" class="form-control" required autofocus>
        <br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>
    </div>
</body>
    </div>
</body>
</html>