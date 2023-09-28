<?php
// definimos variables
$nombre = $_GET['nombre'];
$apellidos = $_GET['apellidos'];
$ht = $_GET['ht'];

// definimos constantes
define("CUOTA_HORA_NORMAL",20);
define("CUOTA_HORA_EXTRA",40);

// Validamos que las horas trabajadas sean un numero entero positivo
if($ht < 0 || !is_numeric($ht)) $error = 'El valor debe ser un numero entero mayor que 0';
// Validamos que no existan cajas vacias


// Evaluamos si hay errores o no
if(!isset($error)) {
	// Esto se ejecuta cuando NO HAY ERRORES
	// determinamos si hay horas extras o no
	if($ht <= 40){
		// no hay horas extras
		$total = $ht * CUOTA_HORA_NORMAL;
	}
	else {
		// hay horas extras
		$he = $ht - 40;
		// sueldo por horas normales
		$sueldo_hn = CUOTA_HORA_NORMAL * 40;
		// sueldo por horas extras
		$sueldo_he = CUOTA_HORA_EXTRA * $he;
		$total = $sueldo_hn + $sueldo_he;

		//$total = (40 * CUOTA_HORA_NORMAL) + (($ht - 40) * CUOTA_HORA_EXTRA);
	}

	// if($var == 1) echo "cosa sencilla";
}
else {
	// esto se ejecuta cuando HAY ERRORES
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ejercicio 1</title>
</head>
<body>
	<h1>Sueldo de un empleado</h1>

	<?php
	if(!isset($error)) { ?>
		<p>El empleado <?php echo "$nombre $apellidos"; ?> trabajó <?php echo $ht; ?> horas por lo que obtuvo un sueldo de $<?php echo $total; ?>, a continuación se presenta un desglose de su sueldo:</p>

	<?php 
		if($ht <= 40) { 
			include("vistas/vista_sin_he.php");
		}
		else {
			include("vistas/vista_con_he.php");
		}

		/* con if ternario 
		include ($ht <= 40) ? "vistas/vista_sin_he.php" : "vistas/vista_con_he.php";
		*/
	}
	else {
		echo $error;
	}?>







</body>
</html>