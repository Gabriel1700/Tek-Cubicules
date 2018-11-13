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
        $consulta="UPDATE peticion SET Status=2 WHERE idPeticion=$reqId";
        mysqli_query($conexion, $consulta);
        $consulta="UPDATE cubiculo SET verificando=0 WHERE numeroCubiculo=$cPos OR numeroCubiculo=$nPos";
        mysqli_query($conexion, $consulta);
      }
    ?>
  </body>
</html>
