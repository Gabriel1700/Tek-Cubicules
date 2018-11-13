<?php

    $db_host="localhost";
    $db_nombre="tekexperts";
    $db_usuario="root";
    $db_contra="";

    $conexion=mysqli_connect($db_host, $db_usuario, $db_contra); //Crear conexion se pide ubicacion, usuario, contrasña y nombre de BD
    
    if(mysqli_connect_errno()){  //Funcion que se ejecuta cuando no se logra conectar a la base de datos
        
        echo "Fallo al conectar con la base de datos";
        exit();
        
    }
    
    mysqli_select_db($conexion, $db_nombre) or die ("No se encuentra la base de datos"); //Si no encuentra la BD porque el nombre es incorrecto
    
    mysqli_set_charset($conexion, "utf8"); //Para tildes

?>