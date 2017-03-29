
<?php
	require_once '../conexao_bd.php'; //chama conexao com o banco
	session_start();
	if (!isset($_SESSION['usuario_session']) && !isset($_SESSION['senha_session'])){ //valida a secao
?>

<!DOCTYPE html>
<html>
<head>
	<title>Loggin</title>
</head>
<body>
	<div id='divlogin'>
		<form method="post" action="?go=logar">
			<table id='tbllogin'>
				<tr>
					<td>Usuario: </td>
					<td><input type='text' name='usuario' id='lblusuario'/></td>
				</tr>	
					<td>Senha: </td>
					<td><input type='password' name='senha' id='lblsenha'/></td>
				</tr>	
				<tr>
					<td colspan="2">
						<input type='submit' value='Confirmar' id='btnconfirmar'/>
						<a href="..\index.php"><input type='button' value='Cancelar' id='btncancelar'/>
					</td>
					
				</tr>		
			</table>
		</form>
	</div>
</body>
</html>

<?php 
	}
	else{
		header('location: index_adm.php');
	}
?>
<?php
	if (@$_GET ['go'] == 'logar'){
		$usuario = $_POST ['usuario'];
		$senha = $_POST ['senha'];
		//$codsenha = md5($senha);

		if(empty($usuario)){
			echo "<script> alert('Preencha o campo USUARIO'); history.back();</script>";
			}
			elseif(empty($senha)){
				echo "<script> alert('Preencha o campo SENHA!'); history.back();</script>";
				}
			//verifica se algum campo esta vazio
			else { //sen tudo estiver certo ele executara os comandos abaixo
				$query1 = mysql_num_rows(mysql_query("SELECT * FROM USUARIO WHERE usuario = '$usuario' AND SENHA ='$senha'")); //valida se existe algum usuario e senha no banco de dados sao iguais aos inseridos 
					if($query1==1){ // se o resultado for positivo ele grava uma session 
						$_SESSION['usuario_session'] = $usuario;
						$_SESSION['senha_session'] = $senha;
						header('location: index_adm.php'); //direciona para o inicio da administracao
					}
					else
								echo "<script> alert('Usuario ou senha incorretos!!');</script>"; //se alguma das informaçoes forem diferentes ele mostrara este alerta
					}
				}	

?>