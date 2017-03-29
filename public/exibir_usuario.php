<?php
	session_start();
	require_once '../conexao_bd.php';
	if (!isset($_SESSION['USUARIO_session']) && !isset($_SESSION['senha_session'])){
		header('location: login.php');
	}	
	else{
?>		

<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
</head>
<body>
	<?php
	$sql = mysql_query("SELECT * FROM USUARIO"); //seleciona do banco de dados tudo oq tem em usuario
		while ($exibe = mysql_fetch_assoc($sql)){ //laço que exibira as informaçoes abaixo ate o valor for invalido
			echo "Nome de Usuario: ", $exibe  ["usuario"]. " <br>";
			echo "Nome do Aluno: ",$exibe ["nome"]. " <br> ";
			echo "Numero de Telefone: ",$exibe ["telefone"]. " <br> ";
			echo "Numero de celular: ",$exibe ["celular"]. " <br> ";
			echo "Email: ",$exibe ["email"]. "<br>";
			echo "<img src='../img_perfil/".$exibe ["foto"]."/> <br> <br>";
		}
	?>

	<a href="index_adm.php"><input type='button' value='Retornar' id='btnretornar'/>
</body>
</html>

<?php 
	}
 ?>