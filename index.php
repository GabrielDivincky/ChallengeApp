<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Medicos</title>
	<link rel="stylesheet" href="CSS/estilos.css">
</head>
<body>
	<div id="contenedor">

	<?php 


		// $url = 'https://www.doctoraliar.com/buscar?q=Odont%C3%B3logo&loc=Rosario&filters%5Bspecializations%5D%5B%5D=50&sorter=recommended';

		// $html = file_get_contents($url);

		// preg_match_all('/(Dr)/',$html, $matches);

		// print_r($matches);
 		

 		require 'simple_html_dom.php';

		$url = 'https://www.doctoraliar.com/buscar?q=Odont%C3%B3logo&loc=Rosario&filters%5Bspecializations%5D%5B%5D=50&sorter=recommended';

		 $html = file_get_html($url);


		$posts = $html->find('div[class=media]');

		foreach ($posts as $post) {
			
			$link = $post->find('h3 a', 0);
			$url = $link->attr['href'];
			$title = $link->innertext;


			 echo $title."<br/>", "\n";
		}

	 ?>


		<h2>Médicos</h2>

		<form action="index.php" method="POST" id="formulario">
			<label for="nombre">Nombre</label><br/>
			<input type="text" class="inputs" name="nombre"><br/>
			
			<label for="apellidos">Apellidos</label><br/>
			<input type="text" class="inputs" name="apellidos"><br/>

			<label for="obraSocial">Obra Social</label><br/>
			<input type="text" class="inputs" name="obraSocial"><br/>

			<label for="especialidad">Especialidad</label><br/>
			<input type="text" class="inputs" name="especialidad"><br/>
			
			<label for="direccion">Dirección</label><br/>
			<input type="text" class="inputs" name="direccion"><br/>
			
			<label for="barrio">Barrio</label><br/>
			<input type="text" class="inputs" name="barrio"><br/>

			<input type="submit" id="boton1" name="boton1" value="enviar">

			<input type="submit" id="boton2" name="boton2" value="consultar">
		</form>

		<?php 


		if(isset($_POST['boton1'])){

			// conexion a la base de datos
			require_once "abrir_conexion.php";

			

			 $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			 $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			 $obraSocial = isset($_POST['obraSocial']) ? $_POST['obraSocial'] : false;
			 $especialidad = isset($_POST['especialidad']) ? $_POST['especialidad'] : false;
			 $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
			 $barrio = isset($_POST['barrio']) ? $_POST['barrio'] : false;


			 $errores = array();

			 // Validación de campos

			 if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
			 	$nombre_validado = true;
			 }else{
			 	$nombre_validado = false;
			 	$errores['nombre'] = "El nombre no es válido";
			 }

			  if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
			 	$apellidos_validado = true;
			 }else{
			 	$apellidos_validado = false;
			 	$errores['apellidos'] = "Los apellidos no son válidos";
			 }
			
				if(!empty($obraSocial)){
						 	$obraSocial_validado = true;
						 }else{
						 	$obraSocial_validado = false;
						 	$errores['obraSocial'] = "La obra Social no es válida";
						 }

				if(!empty($especialidad)){
						 	$especialidad_validada = true;
						 }else{
						 	$especialidad_validada = false;
						 	$errores['especialidad'] = "La especialidad no es válida";
						 }

			 if(!empty($direccion)){
			 	$direccion_validado = true;
			 }else{
			 	$direccion_validado = false;
			 	$errores['direccion'] = "La dirección no es válida";
			 }


			 
			if(!empty($barrio)){
						 	$barrio_validado = true;
							 }else{
							 	$barrio_validado = false;
							 	$errores['barrio'] = "El barrio no es válido";
							 }


			 $guardar_medico = false;
			 if (count($errores) == 0) {

				 	$guardar_medico = true;
				 	// INSERTAR MEDICO EN BD
				 
				 	$sql = "INSERT INTO medicos VALUES(null, '$nombre', '$apellidos', $obraSocial, '$especialidad','$direccion','$barrio')";

				 	$guardar = mysqli_query($conexionDB, $sql);


				 	if($guardar){
				 		echo "El registro se completo con exito";
				 	}else{
				 		echo "Fallo al guardar en la base de datos";
				 	}


			 };


			};


		if(isset($_POST['boton2'])){


			// conexion a la base de datos
			require_once "abrir_conexion.php";	

			 $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			 $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			 $obraSocial = isset($_POST['obraSocial']) ? $_POST['obraSocial'] : false;
			 $especialidad = isset($_POST['especialidad']) ? $_POST['especialidad'] : false;
			 $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
			 $barrio = isset($_POST['barrio']) ? $_POST['barrio'] : false;



			$consulta = "SELECT * FROM medicos WHERE nombre = '$nombre'";
			$resultados = mysqli_query($conexionDB, $consulta);

			while ($busqueda= mysqli_fetch_array($resultados)) {
				
				echo "

				<table width=\"100%\" border=\"1\">
					<tr>
						<td><b><center>Nombre</center></b></td>
						<td><b><center>Apellidos</center></b></td>
						<td><b><center>Obra Social</center></b></td>
						<td><b><center>Especialidad</center></b></td>
						<td><b><center>Dirección</center></b></td>
						<td><b><center>Barrio</center></b></td>
					</tr>
					<tr>
						<td>".$busqueda['nombre']."</td>
						<td>".$busqueda['apellido']."</td>
						<td>".$busqueda['obra_social']."</td>
						<td>".$busqueda['especialidad']."</td>
						<td>".$busqueda['direccion']."</td>
						<td>".$busqueda['barrio']."</td>
					</tr>	
				</table>

				";
			}

		}	

?>
	</div>
</body>
</html>

