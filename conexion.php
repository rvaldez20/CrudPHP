<?php
	// Conexión base de atos
	// http://php.net/manual/es/pdo.connections.php

	$link = 'mysql:host=localhost;dbname=yt_colores';
	$usuario = 'root';
	$pass = '6038987210';

	try {
		$pdo = new PDO($link,$usuario,$pass);
		//echo 'Conectado';
		//echo '<br>';

		// foreach($pdo->query('SELECT * from colores') as $fila) {
		//   print_r($fila);
		//   echo '<br>';
		// }

	} catch (PDOException $e) {
		print "¡Error!: " . $e->getMessage() . "<br/>";
		die();
	}
