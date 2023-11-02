<?php

// Incluimos la conexión a la base de datos
include("connections/conn_localhost.php");

// Incluimos las utilerías
include("helpers/utils.php");

//Evaluamos si el formulario ha sido enviado, para eso checamos si está definido el indice del botón que envía el formulario
if(isset($_POST['user_register_sent'])) {
  
  // Validamos si no hay campos vacios
  foreach($_POST as $calzon => $caca) {
    if($caca == "" && $calzon != "phone") $error[] = "The $calzon field is required";
  }

  // Validamos si los passwords coinciden
  if($_POST['password'] != $_POST['confirm_password']) $error[] = "The passwords didn't match";

  // Si estamos libres de errores, procedemos a guardar el usuario en la BD
  if(!isset($error)) {
    // Preparamos el query para guardar el usuario en la BD
    $queryInsertUser = sprintf(
      "INSERT INTO users (firstname, lastname, email, password, phone, role) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
      mysqli_real_escape_string($connLocalhost, trim($_POST['firstname'])),
      mysqli_real_escape_string($connLocalhost, trim($_POST['lastname'])),
      mysqli_real_escape_string($connLocalhost, trim($_POST['email'])),
      mysqli_real_escape_string($connLocalhost, trim($_POST['password'])),
      mysqli_real_escape_string($connLocalhost, trim($_POST['phone'])),
      mysqli_real_escape_string($connLocalhost, trim($_POST['role']))
    );

    // Ejecutamos el query
    mysqli_query($connLocalhost, $queryInsertUser) or trigger_error("The user register query has failed.");

    // Redireccionamos al usuario cuando todo ha salido bien
    header("Location: cpanel.php?userRegister=true");

  }

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User register | My San Carlos Vacation, San Carlos Property Rentals</title>

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


<div class="txt_navbar" id="navbar"><strong>You are here:</strong> <a href="index.php">Home</a> &raquo; <a href="cpanel.php">Control Panel</a> &raquo; User register
</div>

<div id="content" class="txt_content">
  <h2>User register</h2>
  <p>Use the form below to register a new user.</p>
  <?php if(isset($error)) printMsg($error, "error"); ?>
  <form action="user_register.php" method="post">
    <table>
      <tr>
        <td><label for="firstname">First name:*</label></td>
        <td><input type="text" name="firstname"></td>
      </tr>
      <tr>
        <td><label for="lastname">Last name:*</label></td>
        <td><input type="text" name="lastname"></td>
      </tr>
      <tr>
        <td><label for="email">Email:*</label></td>
        <td><input type="text" name="email"></td>
      </tr>
      <tr>
        <td><label for="password">Password:*</label></td>
        <td><input type="password" name="password"></td>
      </tr>
      <tr>
        <td><label for="confirm_password">Confirm password:*</label></td>
        <td><input type="password" name="confirm_password"></td>
      </tr>
      <tr>
        <td><label for="phone">Phone:</label></td>
        <td><input type="text" name="phone"></td>
      </tr>
      <tr>
        <td><label for="role">Role:</label></td>
        <td>
          <select name="role">
            <option value="agent" selected>Agent</option>
            <option value="admin">Administrator</option>
          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="Register user" name="user_register_sent"></td>
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
