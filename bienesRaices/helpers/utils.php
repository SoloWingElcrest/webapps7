<?php
// Función para impresión de mensajes simples y complejos, puede imprimir una cadena o un conjunto de cadenas en un array
function printMsg($msg, $msg_type) {
	echo "<div class=\"$msg_type\">";
	
	if(is_array($msg)) {
		echo "<ul>";
		foreach($msg as $caca) {
			echo "<li>$caca</li>";
		}
		echo "</ul>";
	}
	else {
		echo $msg;
	}

	echo "</div>";
}

// Lógica para cerrar la sesión cuando se detecte el flag logOff en $_GET y su valor sea igual a "true"
if(isset($_GET["logOff"]) && $_GET["logOff"] == "true") {
	// Destruimos la sesión
	session_destroy();
	// Redireccionamos al usuario al login
	header("Location: login.php?loggedOff=true");
}
?>