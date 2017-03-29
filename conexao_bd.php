<?php
	$con = @mysql_connect('localhost', 'root', '' ) or die ('Não foi possivel conectar com o banco de dados!');
	mysql_select_db('tcc', $con) or die ('Banco de dados não localizado');
?>