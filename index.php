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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cubicules</title>
	<link rel="shortcut icon" href="src/icono.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>*{margin:0px;}</style>
</head>
<body>
        <!-- Static navbar -->
        <style media="screen">
          .navbar {
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
          }
        </style>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="index.php"><img style="margin-top: 7px;" src="./src/logo.png" alt=""></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="sent-requests.php">View sent requests</a></li>
                <?php
                if ($_SESSION["userType"]==1) {
                  echo "<li><a href='accept-deny.php'>Accept / deny requests</a></li>";
                  echo "<li><a href='#'>Add / delete employees</a></li>";
                  echo "<li><a href='register.php'>Add /delete users</a></li>";
                }
                 ?>
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li><a href="reset-password.php">Change password</a></li>
                <li><a href="logout.php">Log out</a></li>
              </ul>
            </div><!--/.nav-collapse -->
          </div><!--/.container-fluid -->
        </nav>

	<div class="container">
	  <div class="row"><div class="col-lg-8">
	  <ul class="nav nav-tabs">
	    <li class="active"><a data-toggle="tab" href="#floor4-A">Floor 4-A</a></li>
	    <li><a data-toggle="tab" href="#floor4-B">Floor 4-B</a></li>
	    <li><a data-toggle="tab" href="#floor5-A">Floor 5-A</a></li>
	    <li><a data-toggle="tab" href="#floor5-B">Floor 5-B</a></li>
	    <li><a data-toggle="tab" href="#floor5-C">Floor 5-C</a></li>
	    <li><a data-toggle="tab" href="#floor6-A">Floor 6-A</a></li>
	    <li><a data-toggle="tab" href="#floor6-B">Floor 6-B</a></li>
	  </ul>
<!-- FLOOR 4-A -->
	  <div class="tab-content">
	    <div id="floor4-A" class="tab-pane fade in active"><br>

        <?php
        $availableS=0;
        $usingS=0;
        $totalS=0;
        $verifyingS=0;
        for ($cont=4126; $cont <=4201 ; $cont++) {
          $totalS=$totalS+1;
          require("conexion.php");
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
              $i= $fila[1];
              if($fila[7]==1) {
                $verifyingS=$verifyingS+1;
              }else
                if($fila[1]==null){
                  $availableS=$availableS+1;
                }else {
                  $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                  $r=mysqli_query($conexion, $q);
                  $row = mysqli_fetch_row($r);
                  $usingS=$usingS+1;
                }
          }
        }

        echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
        ?>


		  <div class="panel panel-default"><div class="panel-body"><br>
	      <div class="row"><div class="col-lg-1"></div>
	      <div class="btn-group">

          <?php
          for ($cont=4201; $cont >=4171 ; $cont--) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==4194||$cont==4178) {
              echo "<br><br><br>";
            }else if ($cont==4186) {
              echo "<br>";
            }
          }
          ?>

	      </div>
	      </div>
	      <div class="row"><div class="col-lg-2"></div>
	      <div class="btn-group" style="margin-left: 0px">
          <?php
          for ($cont=4170; $cont >=4165 ; $cont--) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
          }
          echo "<br><br><br>";
          ?>
	      </div>
	      </div>
	      <div class="row"><div class="col-lg-1"></div>
	      <div class="btn-group">

        <?php
          for ($cont=4164; $cont >=4126 ; $cont--) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require('while.php');
            if ($cont==4149||$cont==4133||$cont==4126) {
              echo "<br><br><br>";
            }else if ($cont==4157||$cont==4141) {
              echo "<br>";
            }
          }
          ?>

	      </div></div>
	      </div>
	      </div>
	    </div>

<!-- FLOOR 4-B -->

	    <div id="floor4-B" class="tab-pane fade"><br>

        <?php
        $availableS=0;
        $usingS=0;
        $totalS=0;
        $verifyingS=0;
        for ($cont=4001; $cont <=4125 ; $cont++) {
          $totalS=$totalS+1;
          require("conexion.php");
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
              $i= $fila[1];
              if($fila[7]==1) {
                $verifyingS=$verifyingS+1;
              }else
                if($fila[1]==null){
                  $availableS=$availableS+1;
                }else {
                  $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                  $r=mysqli_query($conexion, $q);
                  $row = mysqli_fetch_row($r);
                  $usingS=$usingS+1;
                }
          }
        }

        echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
        ?>

		  <div class="panel panel-default"><div class="panel-body"><br>
	      <div class="row"><div class="col-lg-4"></div>
	      <div class="btn-group">

<!-- 4119 - 4125
brbrbr 4125 -->

<?php
  for ($cont=4119; $cont <=4125 ; $cont++) {
    require("conexion.php");
    $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
    $resultado=mysqli_query($conexion, $consulta);
    require("while.php");
    if ($cont==4125) {
      echo "<br><br><br>";
    }
  }
  ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-3"></div>
	      <div class="btn-group">

<?php
  for ($cont=4111; $cont <=4118 ; $cont++) {
    require("conexion.php");
    $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
    $resultado=mysqli_query($conexion, $consulta);
    require("while.php");
    if ($cont==4118) {
      echo "<br>";
    }
  }
  ?>

  <!-- 4103 - 4110 -->
  <!-- brbrbr 4110 -->

  <?php
    for ($cont=4103; $cont <=4110 ; $cont++) {
      require("conexion.php");
      $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
      $resultado=mysqli_query($conexion, $consulta);
      require("while.php");
      if ($cont==4110) {
        echo "<br><br><br>";
      }
    }
    ?>

    <?php
      for ($cont=4095; $cont <=4102 ; $cont++) {
        require("conexion.php");
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        if ($cont==4102) {
          echo "<br>";
        }
      }
      ?>

      <!-- 4087 4094 -->

      <?php
        for ($cont=4087; $cont <=4094 ; $cont++) {
          require("conexion.php");
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
          if ($cont==4094) {
            echo "<br><br><br>";
          }
        }
        ?>

	      </div>
	      </div>
	      <div class="row"><div class="col-lg-4"></div>
	      <div class="btn-group">

          <?php
            for ($cont=4080; $cont <=4086 ; $cont++) {
              require("conexion.php");
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              if ($cont==4086) {
                echo "<br>";
              }
            }
            ?>

            <?php
              for ($cont=4074; $cont <=4079 ; $cont++) {
                require("conexion.php");
                $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                $resultado=mysqli_query($conexion, $consulta);
                require("while.php");
                if ($cont==4079) {
                  echo "<br><br><br>";
                }
              }
              ?>
	  	  </div></div>
	  	  <div class="row"><div class="col-lg-3"></div>
	      <div class="btn-group">

          <?php
            for ($cont=4066; $cont <=4073 ; $cont++) {
              require("conexion.php");
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              if ($cont==4073) {
                echo "<br>";
              }
            }
            ?>

            <?php
              for ($cont=4058; $cont <=4065 ; $cont++) {
                require("conexion.php");
                $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                $resultado=mysqli_query($conexion, $consulta);
                require("while.php");
                if ($cont==4065) {
                  echo "<br><br><br>";
                }
              }
              ?>

              <?php
                for ($cont=4050; $cont <=4057 ; $cont++) {
                  require("conexion.php");
                  $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                  $resultado=mysqli_query($conexion, $consulta);
                  require("while.php");
                  if ($cont==4057) {
                    echo "<br>";
                  }
                }
                ?>

                <?php
                  for ($cont=4042; $cont <=4049 ; $cont++) {
                    require("conexion.php");
                    $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                    $resultado=mysqli_query($conexion, $consulta);
                    require("while.php");
                    if ($cont==4049) {
                      echo "<br><br><br>";
                    }
                  }
                  ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
        <?php
          for ($cont=4036; $cont <=4041 ; $cont++) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
          }
          ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
        <?php
          for ($cont=4029; $cont <=4035 ; $cont++) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==4035) {
              echo "<br><br><br>";
            }
          }
          ?>
	  	  </div></div>
	  	  <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
        <?php
          for ($cont=4022; $cont <=4028 ; $cont++) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==4028) {
              echo "<br>";
            }
          }
          ?>

          <?php
            for ($cont=4015; $cont <=4021 ; $cont++) {
              require("conexion.php");
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              if ($cont==4021) {
                echo "<br><br><br>";
              }
            }
            ?>
	      </div>
	      </div>
	      <div class="row"><div class="col-lg-2"></div>
		  <div class="btn-group" style="margin-left: 5px">
        <?php
          for ($cont=4007; $cont <=4014 ; $cont++) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==4014) {
              echo "<br><br><br>";
            }
          }
          ?>
		  </div></div>
		  <div class="row"><div class="col-lg-3"></div>
		  <div class="btn-group" style="margin-left: 5px">
        <?php
          for ($cont=4001; $cont <=4006 ; $cont++) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==4006) {
              echo "<br><br><br>";
            }
          }
          ?>
		  </div></div>
	  	  </div>
	      </div>
	    </div>
<!-- FLOOR 5-A -->
	    <div id="floor5-A" class="tab-pane fade"><br>

        <?php
        $availableS=0;
        $usingS=0;
        $totalS=0;
        $verifyingS=0;
        for ($cont=5122; $cont <=5206 ; $cont++) {
          $totalS=$totalS+1;
          require("conexion.php");
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
              $i= $fila[1];
              if($fila[7]==1) {
                $verifyingS=$verifyingS+1;
              }else
                if($fila[1]==null){
                  $availableS=$availableS+1;
                }else {
                  $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                  $r=mysqli_query($conexion, $q);
                  $row = mysqli_fetch_row($r);
                  $usingS=$usingS+1;
                }
          }
        }

        echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
        ?>

		  <div class="panel panel-default"><div class="panel-body"><br>
	      <div class="row"><div class="col-lg-1"></div>
	      <div class="btn-group">
<!-- 5206 5176
brbrbr 5200 5188 5176
br 5194 5182 -->
<?php
  for ($cont=5206; $cont >=5176 ; $cont--) {
    require("conexion.php");
    $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
    $resultado=mysqli_query($conexion, $consulta);
    require("while.php");
    if ($cont==5200||$cont==5188||$cont==5176) {
      echo "<br><br><br>";
    }else if ($cont==5194||$cont==5182) {
      echo "<br>";
    }
  }
  ?>
	      </div>
	      </div>
	      <div class="row"><div class="col-lg-2"></div>
	      <div class="btn-group">
          <?php
            for ($cont=5175; $cont >=5168 ; $cont--) {
              require("conexion.php");
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              if ($cont==5168) {
                echo "<br><br><br>";
              }else if ($cont==5172) {
                echo "<br>";
              }
            }
            ?>
	  	  </div></div>
	  	  <div class="row"><div class="col-lg-1"></div>
	      <div class="btn-group">
<!-- 5167 5144
br 5162 5150
brbrbr 5156 5144 -->

<?php
  for ($cont=5167; $cont >=5144 ; $cont--) {
    require("conexion.php");
    $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
    $resultado=mysqli_query($conexion, $consulta);
    require("while.php");
    if ($cont==5156||$cont==5144) {
      echo "<br><br><br>";
    }else if ($cont==5162||$cont==5150) {
      echo "<br>";
    }
  }
  ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-3"></div>
		  <div class="btn-group">
        <?php
          for ($cont=5143; $cont >=5140 ; $cont--) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
          }
          ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-1"></div>
		  <div class="btn-group">
        <?php
          for ($cont=5139; $cont >=5134 ; $cont--) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==5134) {
              echo "<br><br><br>";
            }
          }
          ?>
	  	  </div></div>
	  	  <div class="row"><div class="col-lg-1"></div>
		  <div class="btn-group">
        <?php
          for ($cont=5133; $cont >=5122 ; $cont--) {
            require("conexion.php");
            $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
            $resultado=mysqli_query($conexion, $consulta);
            require("while.php");
            if ($cont==5122) {
              echo "<br><br><br>";
            }else if ($cont==5128) {
              echo "<br>";
            }
          }
          ?>
		  </div></div>
	  	  </div>
	      </div>
	    </div>
<!-- FLOOR 5-B -->
	    <div id="floor5-B" class="tab-pane fade"><br>

        <?php
        $availableS=0;
        $usingS=0;
        $totalS=0;
        $verifyingS=0;
        for ($cont=5098; $cont <=5121 ; $cont++) {
          $totalS=$totalS+1;
          require("conexion.php");
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
              $i= $fila[1];
              if($fila[7]==1) {
                $verifyingS=$verifyingS+1;
              }else
                if($fila[1]==null){
                  $availableS=$availableS+1;
                }else {
                  $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                  $r=mysqli_query($conexion, $q);
                  $row = mysqli_fetch_row($r);
                  $usingS=$usingS+1;
                }
          }
        }

        echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
        ?>

		  <div class="panel panel-default"><div class="panel-body"><br>
	      <div class="row"><div class="col-lg-2"></div>
	      <div class="col-lg-3">
	      <div class="btn-group">

          <?php
              require("conexion.php");
              $cont=5121;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              $cont=5117;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              echo "<br>";
              $cont=5120;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              $cont=5116;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              echo "<br>";
              $cont=5119;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              $cont=5115;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              echo "<br>";
              $cont=5118;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              $cont=5114;
              $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
              $resultado=mysqli_query($conexion, $consulta);
              require("while.php");
              echo "<br><br><br>";
            ?>
        </div></div>
	      <div class="col-lg-3">
	      <div class="btn-group">

        <?php

        $cont=5113;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5109;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br>";
        $cont=5112;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5108;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br>";
        $cont=5111;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5107;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br>";
        $cont=5110;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5106;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br><br><br>";
        ?>
        </div></div>
	      <div class="col-lg-3">
	      <div class="btn-group">
        <?php

        $cont=5105;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5101;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br>";
        $cont=5104;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5100;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br>";
        $cont=5103;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5099;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br>";
        $cont=5102;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        $cont=5098;
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
        echo "<br><br><br>";
        ?>
	      </div></div>
	      </div>
	      </div>
	      </div>
	    </div>
<!-- FLOOR 5-C -->
	    <div id="floor5-C" class="tab-pane fade"><br>

        <?php
        $availableS=0;
        $usingS=0;
        $totalS=0;
        $verifyingS=0;
        for ($cont=5001; $cont <=5097 ; $cont++) {
          $totalS=$totalS+1;
          require("conexion.php");
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
              $i= $fila[1];
              if($fila[7]==1) {
                $verifyingS=$verifyingS+1;
              }else
                if($fila[1]==null){
                  $availableS=$availableS+1;
                }else {
                  $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                  $r=mysqli_query($conexion, $q);
                  $row = mysqli_fetch_row($r);
                  $usingS=$usingS+1;
                }
          }
        }

        echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
        ?>

		  <div class="panel panel-default"><div class="panel-body"><br>
	      <div class="row"><div class="col-lg-4"></div>
	      <div class="btn-group">
        <?php

        for ($cont=5091; $cont <=5097 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";

        for ($cont=5085; $cont <=5090 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br>";

        for ($cont=5079; $cont <=5084 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";

        for ($cont=5073; $cont <=5078 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br>";

        for ($cont=5067; $cont <=5072 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";
        ?>
	      </div>
	      </div>
	      <div class="row"><div class="col-lg-5"></div>
	      <div class="btn-group">
        <?php
        for ($cont=5059; $cont <=5066 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
          if ($cont==5062) {
            echo "<br>";
          }elseif ($cont==5066) {
            echo "<br><br><br>";
          }
        }
        ?>
	  	  </div></div>
	  	  <div class="row"><div class="col-lg-4"></div>
	      <div class="btn-group">
        <?php
        for ($cont=5053; $cont <=5058 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br>";
        for ($cont=5047; $cont <=5052 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";
        for ($cont=5041; $cont <=5046 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br>";
        for ($cont=5035; $cont <=5040 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";
        ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
	      <?php

        for ($cont=5030; $cont <=5034 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }

        ?>
	  	  </div></div>
	      <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
	      <?php
        for ($cont=5025; $cont <=5029 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";
        ?>
	  	  </div></div>
	  	  <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
	      <?php

        for ($cont=5019; $cont <=5024 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br>";
        for ($cont=5013; $cont <=5018 ; $cont++) {
          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
          $resultado=mysqli_query($conexion, $consulta);
          require("while.php");
        }
        echo "<br><br><br>";
        ?>
		  </div></div>
		  <div class="row"><div class="col-lg-4"></div>
		  <div class="btn-group">
	    <?php
      for ($cont=5007; $cont <=5012 ; $cont++) {
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
      }
      echo "<br>";
      for ($cont=5001; $cont <=5006 ; $cont++) {
        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
        $resultado=mysqli_query($conexion, $consulta);
        require("while.php");
      }
      echo "<br><br><br>";
      ?>

		  </div></div>
	  	  </div>
	      </div>
	    </div>
<!-- FLOOR 6-A -->
      	    <div id="floor6-A" class="tab-pane fade"><br>
              <?php
              $availableS=0;
              $usingS=0;
              $totalS=0;
              $verifyingS=0;
              for ($cont=6126; $cont <=6249 ; $cont++) {
                $totalS=$totalS+1;
                require("conexion.php");
                $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                $resultado=mysqli_query($conexion, $consulta);
                while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
                    $i= $fila[1];
                    if($fila[7]==1) {
                      $verifyingS=$verifyingS+1;
                    }else
                      if($fila[1]==null){
                        $availableS=$availableS+1;
                      }else {
                        $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                        $r=mysqli_query($conexion, $q);
                        $row = mysqli_fetch_row($r);
                        $usingS=$usingS+1;
                      }
                }
              }

              echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
              ?>


      		  <div class="panel panel-default"><div class="panel-body"><br>
      	      <div class="row"><div class="col-lg-1"></div>
      	      <div class="btn-group">
                <?php
                for ($cont=6249; $cont >=6213 ; $cont--) {
                  require("conexion.php");
                  $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                  $resultado=mysqli_query($conexion, $consulta);
                  require("while.php");
                  if ($cont==6237||$cont==6221) {
                    echo "<br>";
                  }elseif ($cont==6245||$cont==6229||$cont==6213) {
                    echo "<br><br><br>";
                  }
                }
                 ?>
      	      </div>
      	      </div>
      	      <div class="row"><div class="col-lg-2"></div>
      	      <div class="btn-group">
                <?php
                for ($cont=6212; $cont >=6201 ; $cont--) {
                  require("conexion.php");
                  $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                  $resultado=mysqli_query($conexion, $consulta);
                  require("while.php");
                  if ($cont==6207) {
                    echo "<br>";
                  }elseif ($cont==6201) {
                    echo "<br><br><br>";
                  }
                }
                 ?>
      	  	  </div></div>
      	  	  <div class="row"><div class="col-lg-1"></div>
      	      <div class="btn-group">
                <?php
                for ($cont=6200; $cont >=6169 ; $cont--) {
                  require("conexion.php");
                  $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                  $resultado=mysqli_query($conexion, $consulta);
                  require("while.php");
                  if ($cont==6193||$cont==6177) {
                    echo "<br>";
                  }elseif ($cont==6185||$cont==6169) {
                    echo "<br><br><br>";
                  }
                }
                 ?>
      	  	  </div></div>
      	      <div class="row"><div class="col-lg-2"></div>
      		  <div class="btn-group">
              <?php
              for ($cont=6169; $cont >=6158 ; $cont--) {
                require("conexion.php");
                $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                $resultado=mysqli_query($conexion, $consulta);
                require("while.php");
                if ($cont==6164) {
                  echo "<br>";
                }elseif ($cont==6158) {
                  echo "<br><br><br>";
                }
              }
               ?>

      	  	  </div></div>
      	      <div class="row"><div class="col-lg-1"></div>
      		  <div class="btn-group">

              <?php
              for ($cont=6157; $cont >=6126 ; $cont--) {
                require("conexion.php");
                $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                $resultado=mysqli_query($conexion, $consulta);
                require("while.php");
                if ($cont==6150||$cont==6134) {
                  echo "<br>";
                }elseif ($cont==6142||$cont==6126) {
                  echo "<br><br><br>";
                }
              }
               ?>
      	  	  </div></div>
      	  	  </div>
      	      </div>
      	    </div>
<!-- FLOOR 6-B -->
            		<div id="floor6-B" class="tab-pane fade"><br>

                  <?php
                  $availableS=0;
                  $usingS=0;
                  $totalS=0;
                  $verifyingS=0;
                  for ($cont=6001; $cont <=6125 ; $cont++) {
                    $totalS=$totalS+1;
                    require("conexion.php");
                    $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                    $resultado=mysqli_query($conexion, $consulta);
                    while($fila = mysqli_fetch_row($resultado)){ //Bucle para mostrar todos los registros de una tabla
                        $i= $fila[1];
                        if($fila[7]==1) {
                          $verifyingS=$verifyingS+1;
                        }else
                          if($fila[1]==null){
                            $availableS=$availableS+1;
                          }else {
                            $q="SELECT * FROM empleado WHERE idEmpleado = $i";
                            $r=mysqli_query($conexion, $q);
                            $row = mysqli_fetch_row($r);
                            $usingS=$usingS+1;
                          }
                    }
                  }

                  echo "<div class='row'><div class='col-lg-3'><h5>Total spaces: <span class='badge' style='background-color: #fff;color:#030303;'>$totalS</span></h5></div><div class='col-lg-3'><h5>Available spaces: <span class='badge' style='background-color: #f8f9fa;color:#030303'>$availableS</span></h5></div><div class='col-lg-2'><h5>In use: <span class='badge' style='background-color: #17a2b8'>$usingS</span></h5></div><div class='col-lg-4'><h5>Waiting for approval: <span class='badge' style='background-color: #28a745'>$verifyingS</span></h5></div></div><br>";
                  ?>

            		  <div class="panel panel-default"><div class="panel-body"><br>
            	      <div class="row"><div class="col-lg-6"></div>
            	      <div class="btn-group">
                      <?php
                      for ($cont=6121; $cont <=6125 ; $cont++) {
                        require("conexion.php");
                        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                        $resultado=mysqli_query($conexion, $consulta);
                        require("while.php");
                      if ($cont==6125) {
                          echo "<br><br><br>";
                        }
                      }
                       ?>
            	  	  </div></div>
            	      <div class="row"><div class="col-lg-3"></div>
            	      <div class="btn-group">
                      <?php
                      for ($cont=6113; $cont <=6120 ; $cont++) {
                        require("conexion.php");
                        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                        $resultado=mysqli_query($conexion, $consulta);
                        require("while.php");
                        if ($cont==6120) {
                          echo "<br>";
                        }
                      }
                       ?>

                       <?php
                       for ($cont=6105; $cont <=6112 ; $cont++) {
                         require("conexion.php");
                         $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                         $resultado=mysqli_query($conexion, $consulta);
                         require("while.php");
                         if ($cont==6112) {
                           echo "<br><br><br>";
                         }
                       }
                        ?>

                        <?php
                        for ($cont=6097; $cont <=6104 ; $cont++) {
                          require("conexion.php");
                          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                          $resultado=mysqli_query($conexion, $consulta);
                          require("while.php");
                          if ($cont==6104||$cont==6134) {
                            echo "<br>";
                          }
                        }
                         ?>

                         <?php
                         for ($cont=6089; $cont <=6096 ; $cont++) {
                           require("conexion.php");
                           $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                           $resultado=mysqli_query($conexion, $consulta);
                           require("while.php");
                           if ($cont==6096) {
                             echo "<br><br><br>";
                           }
                         }
                          ?>
            	      </div>
            	      </div>
            	      <div class="row"><div class="col-lg-4"></div>
            	      <div class="btn-group">

                      <?php
                      for ($cont=6083; $cont <=6088 ; $cont++) {
                        require("conexion.php");
                        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                        $resultado=mysqli_query($conexion, $consulta);
                        require("while.php");
                        if ($cont==6088) {
                          echo "<br>";
                        }
                      }
                       ?>

                       <?php
                       for ($cont=6077; $cont <=6082 ; $cont++) {
                         require("conexion.php");
                         $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                         $resultado=mysqli_query($conexion, $consulta);
                         require("while.php");
                         if ($cont==6082) {
                           echo "<br><br><br>";
                         }
                       }
                        ?>
            	  	  </div></div>
            	  	  <div class="row"><div class="col-lg-3"></div>
            	      <div class="btn-group">

                      <?php
                      for ($cont=6069; $cont <=6076 ; $cont++) {
                        require("conexion.php");
                        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                        $resultado=mysqli_query($conexion, $consulta);
                        require("while.php");
                        if ($cont==6076) {
                          echo "<br>";
                        }
                      }
                       ?>


                       <?php
                       for ($cont=6061; $cont <=6068 ; $cont++) {
                         require("conexion.php");
                         $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                         $resultado=mysqli_query($conexion, $consulta);
                         require("while.php");
                         if ($cont==6068) {
                           echo "<br><br><br>";
                         }
                       }
                        ?>

                        <?php
                        for ($cont=6053; $cont <=6060 ; $cont++) {
                          require("conexion.php");
                          $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                          $resultado=mysqli_query($conexion, $consulta);
                          require("while.php");
                          if ($cont==6060) {
                            echo "<br>";
                          }
                        }
                         ?>

                         <?php
                         for ($cont=6045; $cont <=6052 ; $cont++) {
                           require("conexion.php");
                           $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                           $resultado=mysqli_query($conexion, $consulta);
                           require("while.php");
                           if ($cont==6052) {
                             echo "<br><br><br>";
                           }
                         }
                          ?>

            	  	  </div></div>
            	      <div class="row"><div class="col-lg-4"></div>
            		  <div class="btn-group">

                    <?php
                    for ($cont=6039; $cont <=6044 ; $cont++) {
                      require("conexion.php");
                      $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                      $resultado=mysqli_query($conexion, $consulta);
                      require("while.php");
                      if ($cont==6044) {
                        echo "<br>";
                      }
                    }
                     ?>

                     <?php
                     for ($cont=6033; $cont <=6038 ; $cont++) {
                       require("conexion.php");
                       $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                       $resultado=mysqli_query($conexion, $consulta);
                       require("while.php");
                       if ($cont==6038) {
                         echo "<br><br><br>";
                       }
                     }
                      ?>

            	  	  </div></div>
            	      <div class="row"><div class="col-lg-3"></div>
            		  <div class="btn-group">

                    <?php
                    for ($cont=6025; $cont <=6032 ; $cont++) {
                      require("conexion.php");
                      $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                      $resultado=mysqli_query($conexion, $consulta);
                      require("while.php");
                      if ($cont==6032) {
                        echo "<br>";
                      }
                    }
                     ?>

                     <?php
                     for ($cont=6017; $cont <=6024 ; $cont++) {
                       require("conexion.php");
                       $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                       $resultado=mysqli_query($conexion, $consulta);
                       require("while.php");
                       if ($cont==6024) {
                         echo "<br><br><br>";
                       }
                     }
                      ?>

                      <?php
                      for ($cont=6009; $cont <=6016 ; $cont++) {
                        require("conexion.php");
                        $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                        $resultado=mysqli_query($conexion, $consulta);
                        require("while.php");
                        if ($cont==6016) {
                          echo "<br>";
                        }
                      }
                       ?>

                       <?php
                       for ($cont=6001; $cont <=6008 ; $cont++) {
                         require("conexion.php");
                         $consulta="SELECT * FROM cubiculo WHERE numeroCubiculo = $cont";
                         $resultado=mysqli_query($conexion, $consulta);
                         require("while.php");
                         if ($cont==6008) {
                           echo "<br><br><br>";
                         }
                       }
                        ?>
            	  	  </div></div>
            	  	  </div>
            	      </div>
            	    </div>
	  </div>
	  </div>
    <form action="create-petition.php" method="post">
      <div class="col-lg-4" id="form">
        <div class="panel panel-default"><div class="panel-heading"><h2 style="color:#17a2b8">Change Position</h2></div>
        <div class="panel-body" style="padding: 25px">
          <div class="form-group">
            <label for="txtManager">Manager email</label>
            <input required type="text" name="uEmail" class="form-control" value="<?php echo htmlspecialchars($_SESSION["username"]); ?>@tek-experts.com"><br>
            <label for="txtEmployee">Employee Name</label>
            <input required type="text" name="eName" class="form-control"><br>
            <label for="txtCPosition">Current Position</label>
            <input required type="text" name="cPosition" class="form-control"><br>
            <label for="txtNPosition">New Position</label>
            <input required type="text" name="nPosition" class="form-control"><br>
            <label for="txtEmployee">Employee Assets</label><br><br>
            <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-1"><span class="fas fa-laptop" style="color:#17a2b8"></span><br></div>
              <div class="col-lg-4"><p style="color:#78797a"></p></div>
              <div class="col-lg-1"><i class="fas fa-headset" style="color:#17a2b8"></i></div>
              <div class="col-lg-2"><p style="color:#78797a"></p></div>
            </div>
            <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-1"><i class="fas fa-desktop" style="color:#17a2b8"></i></div>
              <div class="col-lg-4"></div>
              <div class="col-lg-1"><i class="fas fa-desktop" style="color:#17a2b8"></i></div>
              <div class="col-lg-2"><p style="color:#78797a"></p></div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-1"><i class="fas fa-phone" style="color:#17a2b8"></i></div>
                <div class="col-lg-2"><p style="color:#78797a"></p></div>
            </div><br>
            <label for="txtEmployee">Cubicule Assets</label><br><br>
            <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-1"><span class="fas fa-hands" style="color:#17a2b8"></span><br></div>
              <div class="col-lg-4"><p style="color:#78797a"></p></div>
              <div class="col-lg-1"><i class="fas fa-chair" style="color:#17a2b8"></i></div>
              <div class="col-lg-2"><p style="color:#78797a"></p></div>
            </div>
            <div class="row">
              <div class="col-lg-1"></div>
              <div class="col-lg-1"><i class="fas fa-plug" style="color:#17a2b8"></i></div>
              <div class="col-lg-4"></div>
              <div class="col-lg-1"><i class="fas fa-phone" style="color:#17a2b8"></i></div>
              <div class="col-lg-4"><p style="color:#78797a"></p></div>
            </div>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-1"><i class="fas fa-globe" style="color:#17a2b8"></i></div>
                <div class="col-lg-4"><p style="color:#78797a"></p></div>
            </div><br>
            <input type='submit' class='btn btn-success' value='Change' style='width: 295px;height: 50px'>
          </div>
        </div>
      </div>
      </div>
    </form>


    <!-- $("button").click(function(){
      var id = $(this).attr("id");
      $.ajax({
        type: "POST",
        url: 'form.php',
        data: {id:id},
        success: function() {
          $("#form").load("form.php");
        }
      });
    }); -->

    <script type="text/javascript">

      $("button").click(function(){
        var id = $(this).attr("id");
        $("#form").load("form.php",{id});
      });
    </script>

	</div>

</div>
<div class="row bg-light" style="position: initial;"></div>
</body>
</html>
