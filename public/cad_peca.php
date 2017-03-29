
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
	<title>Cadastror de Peça</title>
</head>
<body>
	<div id="divcadastropeca">
		<form method="post" action="?go=cadastrar" enctype="multipart/form-data">
			<table id="tablecadastrarpeca">
				<tr>
					<td>Nome da Peça:</td>
					<td><input type='text' name='titulo' id='lbltitulo'  maxlength='15'/></td>
				</tr>
				<tr>
					<td>Subtitulo:</td>
					<td><input type='text' name='subtitulo' id='lblsubtitulo'  maxlength='15'/></td>
				</tr>
				<tr>
					<td>Sinopse:</td>
					<td><input type='textarea' rows="5" cols="200" name='sinopse' id='txtsinopse' /></td>
				</tr>
				<tr>
					<td>Imagen de Exibição:<td>
					<td><input type='file' name='imgexibicao'/></td>
				</tr>
				<tr>
					<td><input type="submit" value="Publicar" id="btnconfirmarnoticia"> </td>
					<td><a href="index_adm.php"><input type='button' value="Cancelar" id="btncancelar" /> </td>
				</tr>
			</table>
		</form>		
	</div>

</body>
</html>

<?php
	if (@$_GET ['go'] == 'cadastrar'){
		$titulo = $_POST ['titulo'];
		$subtitulo = $_POST ['subtitulo'];
		$sinopse = $_POST ['sinopse'];
		$imgexibicao = $_FILE ['imgexibicao'];
		$data= date("d/m/y - H:i:s",time()); //variavel que grava o horario do servidor

		if(empty($titulo)){
			echo "<script> alert('Preencha o campo NOME DA PEÇA'); history.back();</script>";
		}
			elseif(empty($subtitulo)){
				echo "<script> alert('Preencha o campo SUBTITULO! '); history.back();</script>";
			}
				
			elseif(empty($sinopse)){
				echo "<script> alert('Preencha o campo SINOPSE! '); history.back();</script>";
			}
		
		else{
			 $query1 = mysql_num_rows(mysql_query("SELECT * FROM PECA WHERE titulo = '$titulo'"));
				if($query1==1){
					echo "<script> alert('O nome da peça ja existe!'); history.back();</script>";
					}

				else{
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imgexibicao["name"], $ext);
					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
					$caminho_imagem = "../img_exibicao_peca/" . $nome_imagem;
					move_uploaded_file($imgexibicao["tmp_name"], $caminho_imagem); //salvando a imagen na pasta img_exibicao_noticia

					mysql_query("INSERT INTO PECA (titulo, subtitulo, sinopse, imgexibicao, datapublicacao) VALUES ('$titulo', '$subtitulo', '$sinopse', '$imgexibicao', '$data')");

						echo "<script> alert ('Noticia Publicada!');</script>";
						echo "<meta http-equiv ='refresh' content='0, url=index_adm.php'>";
					}
			}				
	}
?>

<?php
	}
?>