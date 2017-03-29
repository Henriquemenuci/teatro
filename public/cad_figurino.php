

<!DOCTYPE html>
<?php
	session_start();
	require_once '../conexao_bd.php';
	if (!isset($_SESSION['USUARIO_session']) && !isset($_SESSION['senha_session'])){
		header('location: login.php');
	}	
	else{
?>
<html>
<head>
	<title>Cadastro Figurino</title>
</head>
<body>
	<div id="divcadastrofigurino">
	<form method="post" action="?go=cadastrar" enctype="multipart/form-data">
		<table id="tablefigurino">
			<tr>
				<td> Nome do Figurino:</td>
				<td><input type='text' name='nome' id='lblnome' maxlength='25'/></td>
			</tr>
			<tr>
				<td> Classificação:</td>
				<td><input type='text' name='classificacao' id='lblclassificacao' maxlength='10'/></td>
			</tr>
			<tr>
				<td> Descrição:</td>
				<td><input type='textarea' rows="2" cols="2000" name='descricao' id='txtdescricao' /></td>
			</tr>
			<tr>
					<td><input type='submit' value='Confirmar' id='btnconfirmar'/></td>
					<td><a href="index_adm.php"><input type='button' value="Cancelar" id="btncancelar" /> </td>
				</tr>
		</table>
		</form>
	</div>
</body>
</html>
<?php
	if (@$_GET ['go'] == 'cadastrar'){
		$nome = $_POST ['nome'];
		$classificacao = $_POST ['classificacao'];
		$descricao = $_POST ['descricao'];

		if(empty($nome)){
			echo "<script> alert('Preencha o campo Nome'); history.back();</script>";
		}
			elseif(empty($classificacao)){
				echo "<script> alert('Preencha o campo Classificação'); history.back();</script>";
		}
			elseif(empty($descricao)){
				echo "<script> alert('Preencha o campo Descrição'); history.back();</script>";
		}
	else{
		$query1 = mysql_num_rows(mysql_query("SELECT * FROM FIGURINO WHERE nome = '$nome'"));
				if($query1==1){
					echo "<script> alert('Nome de figurino ja existe!'); history.back();</script>";
				}
				else{
					mysql_query("INSERT INTO FIGURINO (nome, classificacao, descricao) VALUES ('$nome', '$classificacao', '$descricao')");
					echo "<script> alert ('Figurino cadastrado com sucesso!!');</script>";
					echo "<meta http-equiv ='refresh' content='0, url=index_adm.php'>";	
					}
		}			
	}

?>
<?php
	}
?>

















