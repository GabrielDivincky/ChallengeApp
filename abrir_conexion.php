<?php 

$servidor = 'localhost';
$usuario = 'root';
$password = '';
$db = 'challengeapp';



$conexionDB = mysqli_connect($servidor, $usuario, $password, $db);



 
 // VERIFICACIÓN DE CONEXION

// if (mysqli_connect_error()) {
// 	echo "La conexión a la base de datos ha fallado:".mysqli_connect_error();
// } else {
// 	echo "Conexión realizada correctamente";
// }


 ?>