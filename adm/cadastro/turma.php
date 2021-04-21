<?php 
require_once("../conexao.php"); 

$idturma = $_POST['idturma'];
$horario = $_POST['horario'];
$cpfprof = $_POST['cpf_prof'];
$nomemod = $_POST['nome'];

$sql = "INSERT INTO turma (idturma, horario, cpfprof, idmod) 
VALUES('$idturma', '$horario', '$cpfprof', '$nomemod')";

if(mysqli_query($conn, $sql)){
	echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'turma.html' </script> ";
}else{
	echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
}

mysqli_close($conn);
?>