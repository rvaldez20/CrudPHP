<?php

	include_once 'conexion.php';

	$id = $_GET['id'];
	$sql_eliminar = 'DELETE FROM colores WHERE id=?';
	$sentencia_eliminar = $pdo->prepare($sql_eliminar);
	$sentencia_eliminar->execute(array($id));

	//Cerra la conexion de la base de datos y sentencia (de eliminar)
	$pdo = null;
	$sentencia_eliminar = null;
	
	//para actualizar la pagina
	header('location:index.php');
