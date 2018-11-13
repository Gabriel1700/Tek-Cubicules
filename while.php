
<?php
while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
    $i= $fila[1];
    if($fila[7]==1) {
      echo "
        <button id='$fila[0]' class='btn btn-success btn-md'>$fila[0]</button>
      ";
    }
    else if($fila[1]==null){
        echo "
        <button id='$fila[0]' class='btn btn-light btn-md'>$fila[0]</button>
        ";
      }
      else {
        echo "
          <button id='$fila[0]' class='btn btn-info btn-md'>$fila[0]</button>
        ";
      }
}
 ?>
