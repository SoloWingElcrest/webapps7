<?php
// Evaluamos si el formulario ha sido enviado o no
if(isset($_GET['sent'])){
	// Ejecutamos codigo para procesar el formulario
	// Definimos una función para imprimir mensajes
	function printMsg($msg) {
		echo "<ul>";
		foreach($msg as $caca) {
			echo "<li>$caca</li>";
		}
		echo "</ul>";
	}

	// definimos variables
	$nombre = $_GET['nombre'];
	$apellidos = $_GET['apellidos'];
	$ht = $_GET['ht'];

	// definimos constantes
	define("CUOTA_HORA_NORMAL",20);
	define("CUOTA_HORA_EXTRA",40);

	// validamos que ninguna caja del formulario quede vacia utilizando un bucle 
	foreach ($_GET as $calzon => $caca) {
		if($caca == "") $error[] = "La caja $calzon es requerida";
	}

	// Validamos que las horas trabajadas sean un numero entero positivo
	if($ht < 0 || !is_numeric($ht)) $error[] = 'El valor debe ser un numero entero mayor que 0';

	// Evaluamos si hay errores o no
	if(!isset($error)) {
		// Esto se ejecuta cuando NO HAY ERRORES
		// determinamos si hay horas extras o no
		if($ht <= 40){
			// no hay horas extras
			$total = $ht * CUOTA_HORA_NORMAL;
			$rutaVista = "vistas/vista_sin_he.php";
		}
		else {
			// hay horas extras
			$he = $ht - 40;
			// sueldo por horas normales
			$sueldo_hn = CUOTA_HORA_NORMAL * 40;
			// sueldo por horas extras
			$sueldo_he = CUOTA_HORA_EXTRA * $he;
			$total = $sueldo_hn + $sueldo_he;
			$rutaVista = "vistas/vista_con_he.php";
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Formulario de captura para calculo de sueldo</title>
</head>
<body>
	<h1>Sueldo de un empleao</h1>

	<?php
	if(!isset($_GET['sent']) || isset($error)){
		// incluimos la vista del formulario
		include('vistas/vista_form.php');
	}
	else {
		// incluimos la vista correspondiente, en este punto el formulario ha sido enviado y esta libre de errores
		include($rutaVista);
	}
	?>
	
</body>
</html>