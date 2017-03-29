<?php
    session_start();
    require_once '../conexao_bd.php';
	if (!isset($_SESSION['USUARIO_session']) && !isset($_SESSION['senha_session'])){
		header('location: login.php'); //direciona para a tela de login se o usuario nao estiver cadastrado
	}	
	else{
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Noticia</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body>
	<div id='divcadastronoticia'>
		<form method="post" action="?go=publicar" enctype="multipart/form-data"> 
			<table id='tblcadastronoticia'>
				<tr>
					<td>Titulo:</td>
					<td><input type='text' name='titulo' id='lbltitulo'  maxlength='20'/></td>
				</tr>
				<tr>
					<td>Assunto:</td>
					<td><input type='text' name='assunto' id='lblassunto'  maxlength='15'/></td>
				</tr>
				<tr>
					<td>Conteudo:</td>
					<td><input type='textarea' rows="5" cols="200" name='conteudo' id='txtconteudo' /></td>
				</tr>
				<tr>
					<td>Palavras Chaves:</td>
					<td><input type='text' name='palavrachave' id='lblpalavrachave'  maxlength='30' ></td>
				</tr>
				<tr>
					<td>Imagen Exibição:<td>
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
	if (@$_GET ['go'] == 'publicar'){
		$titulo = $_POST ['titulo'];
		$assunto = $_POST ['assunto'];
		$conteudo = $_POST ['conteudo'];
		$palavrachave = $_POST['palavrachave'];
		$imgexibicao = $_FILES['imgexibicao'];
		$data= date("d/m/y - H:i:s",time()); //variavel que grava o horario do servidor
		

		if(empty($titulo)){// faz algumas validacoes para ver se nao tem nenhum campo vazio
			echo "<script> alert('Preencha o campo TITULO!'); history.back();</script>";
		}
			elseif(empty($assunto)){
				echo "<script> alert('Preencha o campo ASSUNTO! '); history.back();</script>";
			}
				
			elseif(empty($conteudo)){
				echo "<script> alert('Preencha o campo CONTEUDO! '); history.back();</script>";
			}
		
			elseif(empty($palavrachave)){
				echo "<script> alert('Preencha o campo PALAVRAS-CHAVES! '); history.back();</script>";
			}
		else {
			$query1 = mysql_num_rows(mysql_query("SELECT * FROM NOTICIA WHERE titulo = '$titulo'")); //verifica se o nome da peca ja existe no banco de dados
				if($query1==1){
					echo "<script> alert('O titulo ja existe!'); history.back();</script>";
					}
						
				else{
					preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imgexibicao["name"], $ext);
					$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
					$caminho_imagem = "../img_exibicao_noticia/" . $nome_imagem;
					move_uploaded_file($imgexibicao["tmp_name"], $caminho_imagem); //salvando a imagen na pasta img_exibicao_noticia
						
						mysql_query("INSERT INTO NOTICIA (titulo, assunto, conteudo, palavrachave, imgexibicao, datapublicacao) VALUES ('$titulo', '$assunto', '$conteudo', '$palavrachave', '$imgexibicao', '$data' )"); //inserindo valores no banco de dados
							echo "<script> alert ('Noticia Publicada!');</script>";// mostra uma mensagem de alerta dizendo que a noticia foi cadastrada 
							echo "<meta http-equiv ='refresh' content='0, url=index_adm.php'>";	//e direciona para o menu adm
					}
			}	
	}	
			
?>
<?php
	}
?>





















