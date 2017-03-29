<?php 
	require_once '../conexao_bd.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Noticias</title>
</head>
<body>
<?php 
	$sql = mysql_query("SELECT * FROM NOTICIA");
		if ( mysql_num_rows == '0'){
			echo "Nenhuma noticia cadastrada";
		}
		else{	
			while ($exibe = mysql_fetch_assoc($sql)){
				echo "Titulo: ", $exibe  ["titulo"]. " <br>";
				echo "", $exibe  ["assunto"]. " <br>";
				echo "", $exibe  ["datapublicacao"]. " <br>";
				echo "", $exibe  ["assunto"]. " <br>";
			}
		}
 ?>

</body>
</html>