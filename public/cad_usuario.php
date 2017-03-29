<?php
	session_start();
	require_once '../conexao_bd.php';
	if (!isset($_SESSION['USUARIO_session']) && !isset($_SESSION['senha_session'])){
		header('location: login.php');
	}	
	else{
?>
<?php

function validaemail($email){
    $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
    	if (preg_match($er, $email)){
			return false;
    	} 
    	else {
			return true;
    	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Cadastro de Usuario</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<body>
	<div id='divcadastrousuario'>
		<form method="post" action="?go=cadastrar" enctype="multipart/form-data">
			<table id='tblcadastrousuario'>
				<tr>
					<td>Usuario:</td>
					<td><input type='text' name='usuario' id='lblusuario'  maxlength='15'/></td>
				</tr>
				<tr>
					<td>Senha:</td>
					<td><input type='password' name='senha' id='lblsenha' maxlength='15'/></td></td>
				</tr>
				<tr>
					<td>Nome:</td>
					<td><input type='text' name='nome' id='lblnome' maxlength='30'/></td></td>
				</tr>
				<tr>
					<td>Telefone:</td>
					<td><input type='text' name='telefone' id='lbltelefone' maxlength='12'/></td></td>
				</tr>
				<tr>
					<td>Celular:</td>
					<td><input type='text' name='celular' id='lblcelular' maxlength='12'/></td></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type='text' name='email' id='lblemail' maxlength='20'/></td></td>
				</tr>
				<tr>
					<td>Foto:<td>
					<td><input type='file' name='imgperfil'/></td>
				</tr>
				<tr>
					<td>
						<select name="tipo_usuario">
                		<option value="">Selecione</option>
                		<option value="0">Usuario Comum</option>
                		<option value="1">Administrador</option>
                	</td>
				</tr>
				<tr>
					<td><input type='submit' value='Confirmar' id='btnconfirmar'/></td>
					<td><a href="index_adm.php"><input type='button' value="Cancelar" id="btncancelar" /> </td>
				</tr>
			</table>
		</form>	
	</table>	
</body>
</html>
<?php
	if (@$_GET ['go'] == 'cadastrar'){
		$usuario = $_POST ['usuario'];
		$senha = $_POST ['senha'];
		$nome = $_POST ['nome'];
		$telefone = $_POST ['telefone'];
		$celular = $_POST ['celular'];
		$email = $_POST ['email'];
		$imgperfil = $_FILES['imgperfil'];

		if(empty($usuario)){
			echo "<script> alert('Preencha o campo USUARIO'); history.back();</script>";
		}
			elseif(empty($senha)){
				echo "<script> alert('Preencha o campo SENHA!'); history.back();</script>";
				}
			elseif(empty($nome)){
				echo "<script> alert('Preencha o campo NOME!'); history.back();</script>";
				}
			elseif(empty($email)){
				echo "<script> alert('Preencha o campo EMAIL!'); history.back();</script>";
				}
			elseif(validaemail($email)){
				echo "<script> alert('EMAIL INVALIDO!'); history.back();</script>";	
				}

		else {
			$query1 = mysql_num_rows(mysql_query("SELECT * FROM USUARIO WHERE usuario = '$usuario'"));
				if($query1==1){
					echo "<script> alert('Usuario Ja existe!'); history.back();</script>";
				}	
				
				
				Else{
						preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imgperfil["name"], $ext);
						$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
						$caminho_imagem = "../img_perfil/" . $nome_imagem;
						move_uploaded_file($imgperfil["tmp_name"], $caminho_imagem); //salvando a imagen na pasta imgperfil

						mysql_query("INSERT INTO USUARIO (usuario, senha, nome, telefone, celular, email, foto) VALUES ('$usuario', '$senha', '$nome', '$telefone', '$celular','$email', '$nome_imagem')");
							echo "<script> alert ('Usuario cadastrado com sucesso!!');</script>";
							echo "<meta http-equiv ='refresh' content='0, url=index_adm.php'>";	
						}
				
					
	
			}		
	}


?>
<?php
	}
?>