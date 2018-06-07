<?php

	// Se realizar por medio del metodo GET (atravez d ela url)
	// echo 'editar.php?id=1&color=success&descripcion=Este es un color verde';
	// echo '<br>';

	$id = $_GET['id'];
	$color = $_GET['color'];
	$descripcion = $_GET['descripcion'];

	// echo $id;
	// echo '<br>';
	// echo $color;
	// echo '<br>';
	// echo $descripcion;

	include_once 'conexion.php';

	$sql_editar = 'UPDATE colores SET color=?,descripcion=? WHERE id=?';
	$sentencia_editar = $pdo->prepare($sql_editar);
	$sentencia_editar->execute(array($color,$descripcion,$id));

	//Cerra la conexion de la base de datos y sentencia (de eliminar)
	$pdo = null;
	$sentencia_editar = null;

	//para actualizar la pagina
	header('location:index.php');