<?php
  
	// Se llama al archivo d ela conexion
	include_once 'conexion.php';

	//Vamos a leer la base de datos con fetchall
	// http://php.net/manual/es/pdostatement.fetchall.php

	//Paso para leer
	// 1.- Una variable con el sql
	// 2.- En una variable vamos a guardar la preparacion y ejecutamos la sencia sql
	// 3.- Con fetchAll guardamos la consulta en forma de array en una variable
  
	//------------------------- LEER colores
	$sql_leer = 'SELECT *  FROM colores';  
	$gsent = $pdo->prepare($sql_leer);
	$gsent->execute();
	$resultado = $gsent->fetchAll();
	//var_dump($resultado);


	//-------------------------- AGREGAR colores
	if($_POST){
		$color = $_POST['color'];
		$descripcion = $_POST['descripcion'];

		$sql_agregar = 'INSERT INTO colores (color,descripcion) VALUES (?,?)';
		$sentencia_agregar = $pdo->prepare($sql_agregar);
		$sentencia_agregar->execute(array($color,$descripcion));

		//Cerra la conexion de la base de datos y sentencia (de agregar)
		$sentencia_agregar = null;
		$pdo = null;

		//para actualizar la pagina
		header('location:index.php');
  	}


  	//-------------------------- MODIFICAR colores
  	if ($_GET){
		$id = $_GET['id'];

		$sql_unico = 'SELECT * FROM colores WHERE id=?';  
		$gsent_unico = $pdo->prepare($sql_unico);
		$gsent_unico->execute(array($id));
		$resultado_unico = $gsent_unico->fetch();

		// var_dump($resultado_unico);
  	}
?>


<!doctype html>
<html lang="en">
  	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

		<!-- Icono desde Font Awesome -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">

		<title>CRUD Colores</title>
  	</head>

  	<body>

		<div class="container mt-5">
			<div class="row">

				<div class="col-md-6">

					<?php foreach($resultado as $dato): ?>
						<div 
						class="alert alert-<?php echo $dato['color'] ?> text-uppercase" 
						role="alert">
							<?php echo $dato['color'] ?>
							-
							<?php echo $dato['descripcion'] ?>

							<a href="eliminar.php?id=<?php echo $dato['id'] ?>" class="float-right ml-3">
								<i class="fas fa-trash-alt"></i>
							</a>

							<a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right">
								<i class="fas fa-pencil-alt"></i>
							</a>
							
						</div>
					<?php endforeach ?>

				</div>



			<div class="col-md-6">

				<!-- Lo muestra cuando no hay parametros en la url (metodo GET) -->
				<?php if(!$_GET): ?>
					<h2>AGREGAR ELEMENTOS</h2>
					<form method="POST">
						<input type="text" class="form-control" name="color">
						<input type="text" class="form-control mt-3" name="descripcion">
						<button class="btn btn-primary mt-3">Agregar</button>
					</form>
				<?php endif ?>

				<!-- Lo muestra cuando si hay parametros en la url (metodo GET) -->
				<?php if($_GET): ?>
					<h2>EDITAR ELEMENTOS</h2>
					<form method="GET" action="editar.php">
						<input type="text" 
							class="form-control" 
							name="color" 
							value="<?php echo $resultado_unico['color'] ?>">
						<input type="text" 
							class="form-control mt-3" 
							name="descripcion" 
							value="<?php echo $resultado_unico['descripcion'] ?>">
						<input type="hidden"   					   
							name='id'
							value="<?php echo $resultado_unico['id'] ?>">
						<button class="btn btn-primary mt-3">Guardar Cambios</button>
					</form>
				<?php endif ?>
			</div>

		</div>
		
		</div>



		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  	</body>
</html>


<?php
	// Cerramos la sesion de la base de datos y sentencia (de lectura)
	$pdo = null;
	$gsent = null;
?>