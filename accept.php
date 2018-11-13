<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
      $reqId = $_REQUEST['reqId'];
      require("conexion.php");
      $consulta="SELECT * FROM peticion WHERE idPeticion=$reqId";
      $resultado=mysqli_query($conexion, $consulta);
      while($fila = mysqli_fetch_row($resultado)){
        $emp = $fila[2];
        $cPos = $fila[3];
        $nPos = $fila[4];
        $sql="UPDATE peticion SET Status=1 WHERE idPeticion=$reqId";
        mysqli_query($conexion, $sql);
        $sql="UPDATE cubiculo SET verificando=0 WHERE numeroCubiculo=$cPos OR numeroCubiculo=$nPos";
        mysqli_query($conexion, $sql);

        $consulta="SELECT * FROM empleado WHERE cubiculoEmpleado=$cPos";
        $resultado=mysqli_query($conexion, $consulta);
        while($fila = mysqli_fetch_row($resultado)){
          $idEmp=$fila[0];
        }

        $sql="UPDATE cubiculo SET idEmpleado=NULL WHERE numeroCubiculo=$cPos";
        mysqli_query($conexion, $sql);

        $sql="UPDATE cubiculo SET idEmpleado=$idEmp WHERE numeroCubiculo=$nPos";
        mysqli_query($conexion, $sql);

        $sql="UPDATE empleado SET cubiculoEmpleado=$nPos WHERE idEmpleado=$idEmp";
        mysqli_query($conexion, $sql);
      }
    ?>
  </body>
</html>
