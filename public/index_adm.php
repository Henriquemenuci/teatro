<?php
    session_start();
	if (!isset($_SESSION['USUARIO_session']) && !isset($_SESSION['senha_session'])){
		header('location: login.php'); //direciona para a tela de login se o usuario nao estiver cadastrado
	}	
	else{
?>


<!DOCTYPE html>
<html>
<head>
	<title>Administração</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body>
	<div>
		<table id='tblindexadm'>
			<ul>
				<li><a href="../index.php">INICIO</a></li>
				<br>
				<h3>NOTICIAS</h3>
				<li><a href="cad_noticia.php">CADASTRAR NOTICIAS</a></li>
				<li><a href="#">EDITAR NOTICIAS</a></li>
				<br>
				<h3>APRESENTAÇÕES</h3>
				<li><a href="cad_peca.php">CADASTRAR PEÇAS</a></li>
				<li><a href="#">EDITAR PEÇAS</a></li>
				<li><a href="#">CADASTRAR APRESENTAÇÕES</a></li>
				<li><a href="#">EDITAR APRESENTAÇÕES</a></li>
				<br>
				<h3>FIGURINOS</h3>
				<li><a href="cad_figurino.php"> CADASTRAR FIGURINOS</a></li>
				<li><a href="#"> EDITAR FIGURINOS</a></li>
				<br>
				<h3>USUARIOS</h3>
				<li><a href="cad_usuario.php">CADASTRAR USUARIO</a></li>
				<li><a href="exibir_usuario.php">EXIBIR USUARIOS CADASTRADOS</li>
				<li><a href="#">EDITAR USUARIOS CADASTRADOS</li>
				<br>
				<?php
					echo "<a href='logout.php'>SAIR</a>";
				?>
			</ul>
		</table>	
	</div>
</body>
</html>

<?php
	}
?>