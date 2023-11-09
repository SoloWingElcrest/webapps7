<?php
// Inicializamos la sesion
if(!isset($_SESSION)) {
  session_start();
}

// Incluimos la conexión a la base de datos y las utilerías
include("connections/conn_localhost.php");
include("helpers/utils.php");

// Evaluamos si el formulario ha sido enviado
if(isset($_POST["login_sent"])) {
  // Validamos que todas las cajas se hayan llenado
  foreach($_POST as $calzon => $caca) {
    if($caca == "") $error[] = "The $calzon field is required.";
  }

  // si no hay error, preparamos el query para buscar al usuario en la bd
  if(!isset($error)) {
    // preparamos el query para buscar al usuario
    $queryUserLogin = sprintf(
      "SELECT id, firstname, lastname, email, role FROM users WHERE email = '%s' AND password = '%s'",
      mysqli_real_escape_string($connLocalhost, trim($_POST['email'])),
      mysqli_real_escape_string($connLocalhost, trim($_POST['password']))
    );

    // Ejecutamos el query y guardamos los resultados en una variable que es un resultset o recordet
    $resQueryUserLogin = mysqli_query($connLocalhost, $queryUserLogin) or trigger_error("The user login query failed.");

    // Determinamos si el login fue valido, para eso contamos los resultados encontrados
    if(mysqli_num_rows($resQueryUserLogin)) {
      // Hacemos un fetch de los resultados
      $userData = mysqli_fetch_assoc($resQueryUserLogin);

      // Definimos valores en SESSION que nos serán utiles en la app
      $_SESSION["userId"] = $userData["id"];
      $_SESSION["userFullname"] = $userData["firstname"]." ".$userData["lastname"];
      $_SESSION["userEmail"] = $userData["email"];
      $_SESSION["userRole"] = $userData["role"];

      // Una vez que se definieron los valores en SESSION, redirigimos al usuario
      header("Location: cpanel.php");
    }
    else {
      $error[] = "Login failed";
    }


  }

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User login | My San Carlos Vacation, San Carlos Property Rentals</title>

<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' />

<link href="css_main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
<!--
function MM_jumpMenuGo(objId,targ,restore){ //v9.0
  var selObj = null;  with (document) { 
  if (getElementById) selObj = getElementById(objId);
  if (selObj) eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0; }
}
//-->
</script>
</head>

<body>
<div id="main">

<?php include("views/layout_header.php"); ?>
<!-- HEADER END -->


<div class="txt_navbar" id="navbar"><strong>You are here:</strong> <a href="index.php">Home</a> &raquo; Login
</div>

<div id="content" class="txt_content">
  <h2>User login</h2>
  &nbsp;
  <?php if(isset($error)) printMsg($error, "error"); ?>
  <?php if(isset($queryUserLogin)) printMsg($queryUserLogin, "exito"); ?>
  <?php if(isset($userData)) var_dump($userData); ?>
  <form action="login.php" method="post">
    <table>
      <tr>
        <td><label for="email">Email:</label></td>
        <td><input type="text" name="email"></td>
      </tr>
      <tr>
        <td><label for="password">Password:</label></td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" name="login_sent" value="Login"></td>
      </tr>
    </table>
  </form>
  
</div>

<!--CONTENT END -->

<?php include("views/layout_sidebar.php"); ?>
<!-- SIDEBAR END -->
<div style="clear: both;"></div>

<?php include("views/layout_footer.php"); ?>
</div>

</body>
</html>
