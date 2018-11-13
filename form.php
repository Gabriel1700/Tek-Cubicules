<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="create-petition.php" method="post">
    <div class="panel panel-default"><div class="panel-heading"><h2 style="color:#17a2b8">Change Position</h2></div>
    <div class="panel-body" style="padding: 25px">
      <div class="form-group">
        <label for="txtManager">Manager email</label>
        <input required type="text" name="uEmail" class="form-control" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>@tek-experts.com"><br>

    <?php
        require("conexion.php");
        $cub = $_REQUEST['id'];
        $consulta="SELECT * FROM empleado WHERE cubiculoEmpleado = $cub ";
        $resultado=mysqli_query($conexion, $consulta);
        $fila = mysqli_fetch_row($resultado); //para tomar todos los registros de una tabla

        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cub ";
        $resultado=mysqli_query($conexion, $consulta);
        $fila2 = mysqli_fetch_row($resultado); //para tomar todos los registros de una tabla
            echo "

            <label for='txtEmployee'>Employee Name</label>
	  	  		<input type='text' name='eName' class='form-control'  value='$fila[1] $fila[2]' required><br>
	  	  		<label for='txtCPosition'>Current Position</label>
	  	  		<input type='text' name='cPosition' class='form-control' value='$fila[4]' required><br>
	  	  		<label for='txtNPosition'>New Position</label>
	  	  		<input type='text' name='nPosition' class='form-control' required><br>
            <label for='txtEmployee'>Employee Assets</label><br><br>
            <div class='row'>
              <div class='col-lg-1'></div>
              <div class='col-lg-1'><span class='fas fa-laptop' style='color:#17a2b8'></span><br></div>
              <div class='col-lg-4'><p style='color:#78797a'>$fila[5]</p></div>
              <div class='col-lg-1'><i class='fas fa-headset' style='color:#17a2b8'></i></div>
              <div class='col-lg-2'><p style='color:#78797a'>$fila[6]</p></div>
            </div>
            <div class='row'>
              <div class='col-lg-1'></div>
              <div class='col-lg-1'><i class='fas fa-desktop' style='color:#17a2b8'></i></div>
              <div class='col-lg-4'><p style='color:#78797a'>$fila[7]</p></div>
              <div class='col-lg-1'><i class='fas fa-desktop' style='color:#17a2b8'></i></div>
              <div class='col-lg-2'><p style='color:#78797a'>$fila[8]</p></div>
            </div>
            <div class='row'>
                <div class='col-lg-1'></div>
                <div class='col-lg-1'><i class='fas fa-phone' style='color:#17a2b8'></i></div>
                <div class='col-lg-2'><p style='color:#78797a'>$fila[9]</p></div>
            </div><br>
            <label for='txtEmployee'>Cubicule Assets</label><br><br>
            <div class='row'>
              <div class='col-lg-1'></div>
              <div class='col-lg-1'><span class='fas fa-hands' style='color:#17a2b8'></span><br></div>
              <div class='col-lg-4'><p style='color:#78797a'>$fila2[2]</p></div>
              <div class='col-lg-1'><i class='fas fa-chair' style='color:#17a2b8'></i></div>
              <div class='col-lg-2'><p style='color:#78797a'>$fila2[3]</p></div>
            </div>
            <div class='row'>
              <div class='col-lg-1'></div>
              <div class='col-lg-1'><i class='fas fa-plug' style='color:#17a2b8'></i></div>
              <div class='col-lg-4'><p style='color:#78797a'>$fila2[4]</p></div>
              <div class='col-lg-1'><i class='fas fa-phone' style='color:#17a2b8'></i></div>
              <div class='col-lg-4'><p style='color:#78797a'>$fila2[5]</p></div>
            </div>
            <div class='row'>
                <div class='col-lg-1'></div>
                <div class='col-lg-1'><i class='fas fa-globe' style='color:#17a2b8'></i></div>
                <div class='col-lg-4'><p style='color:#78797a'>$fila2[6]</p></div>
            </div><br>
	  	  		<input type='submit' class='btn btn-success' value='Change' style='width: 295px;height: 50px'>
	  	  	</div>
	  	  </div>
	  	</div>


            ";


    ?>
  </form>


  </body>
</html>
