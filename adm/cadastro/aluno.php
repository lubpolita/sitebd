<?php 
require_once("../conexao.php"); 

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$venc_matricula = $_POST['venc_matricula'];
$nascimento = $_POST['nascimento'];
$andress = $_POST['adress'];
$sexo = $_POST['sexo'];
$horario_consulta = $_POST['horario_consulta'];
$cpf_nutri = $_POST['cpf_nutri'];
$nutri = $_POST['nutri'];

if($nutri == 'yes') {

$sql = "INSERT INTO aluno (cpf, nome, venc_matricula, nascimento, endereco, sexo, horarioconsulta, cpfnutricionista) 
VALUES('$cpf', '$nome', '$venc_matricula', '$nascimento', '$andress', '$sexo', '$horario_consulta', '$cpf_nutri')";

}
if else ($nutri == 'not') {
$sql = "INSERT INTO aluno (cpf, nome, venc_matricula, nascimento, endereco, sexo) 
VALUES('$cpf', '$nome', '$venc_matricula', '$nascimento', '$andress', '$sexo')";
	
}

else { 
	echo 'Selecione uma opção'; 
}

#testando query
if(mysqli_query($conn, $sql)){
	echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'aluno.html' </script> ";
}else{
	echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
}
mysqli_close($conn);
?>