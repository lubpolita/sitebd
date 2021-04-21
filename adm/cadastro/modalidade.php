<?php 
require_once("../conexao.php"); 

$id = $_POST['idmod'];
$nome = $_POST['nome'];

$sql = "INSERT INTO modalidade (idMod2, nomeMod) VALUES('$id','$nome')";



if(mysqli_query($conn, $sql)){
	echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'modalidade.html' </script> ";
}else{
	echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
}

mysqli_close($conn);
?>