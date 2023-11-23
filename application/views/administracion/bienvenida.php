<!DOCTYPE html>
<html>
<head/>
<body>
	<h1>Plataforma - Zona privada</h1>
	<p>Bienvenid@&nbsp;<?=$administrador['NOMBRE'] . ' ' . $administrador['APELLIDOS']?>!!</p>
	<p>Has iniciado sesión en la zona privada.</p>
	<br/>
	<button onclick="window.location.href='<?=site_url(RUTA_ADMINISTRACION . '/empleados/listado')?>'">Gestionar empleados</button>
	<br/>
	<br/>
	<button onclick="window.location.href='<?=site_url(RUTA_ADMINISTRACION . '/administrador/logout')?>'">Cerrar sesión</button>
</body>
</html>
