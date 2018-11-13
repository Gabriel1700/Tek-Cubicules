<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Recibimos por POST los datos procedentes del formulario

$usuario = $_POST["uEmail"];
$empleado = $_POST["eName"];
$posicionAct = $_POST["cPosition"];
$posicionNue = $_POST["nPosition"];
$fecha= date("Y-m-d H:i:s");

// Abrimos la conexion a la base de datos
include("conexion.php");

if ($posicionAct==$posicionNue) {
  echo "
  <script>alert
    ('Can't relocate to the same cubicule.');
    window.location.replace('index.php')
  </script>";
  mysqli_close($conexion);
}

if ($posicionAct<>$posicionNue){
  $sql="SELECT * FROM cubiculo WHERE numeroCubiculo=$posicionNue";
  $resultado=mysqli_query($conexion, $sql);

  while($fila = mysqli_fetch_row($resultado)){
    if ($fila[1]==null) {
      $sql = "INSERT INTO peticion (usuario,empleado,posicionAct,posicionNue,fecha) VALUES ('$usuario','$empleado','$posicionAct','$posicionNue',NOW())";
      mysqli_query($conexion,$sql);

      $sql = "UPDATE cubiculo SET verificando=1 WHERE numeroCubiculo=$posicionAct OR numeroCubiculo=$posicionNue";
      mysqli_query($conexion,$sql);

      // Cerramos la conexion a la base de datos
      mysqli_close($conexion);
      header("location: index.php");
    }else {
      echo "
      <script>alert
        ('Can't relocate to an occupied cubicule.);
        window.location.replace('index.php')
      </script>";
      mysqli_close($conexion);
    }
  }
}
