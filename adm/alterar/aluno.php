<?php
require_once("../conexao.php");

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$venc_matricula = $_POST['venc_matricula'];
$nascimento = $_POST['nascimento'];
$address = $_POST['address'];
$sexo = $_POST['sexo'];
$horario_consulta = $_POST['horario_consulta'];
$cpf_nutri = $_POST['cpf_nutri'];
$option = $_POST['option'];


#$sql = "INSERT INTO aluno (cpf, nome, venc_matricula, nascimento, endereco, sexo, horarioconsulta, cpfnutricionista)
#VALUES('$cpf', '$nome', '$venc_matricula', '$nascimento', '$address', '$sexo', '$horario_consulta', '$cpf_nutri')";

if ($option == 'alterar'){

  $sql =

  "UPDATE aluno
  SET cpf = '$cpf', nome = '$nome', venc_matricula = $venc_matricula, nascimento = '$nascimento', sexo = '$sexo',
  endereco = '$address', horarioconsulta = '$horario_consulta', cpfnutricionista = '$cpf_nutri'
  WHERE cpf = '$cpf'";

  if(mysqli_query($conn, $sql)){
    echo "<script> alert('funcionario alterado com sucesso!'); window.location = 'aluno.html' </script> ";
  }else{
    echo "Os dados não foram alterados devido ao seguinte erro <br>". mysqli_error($conn);
  }
}

else if ($option == 'excluir'){
    #echo 'opção excluir';
    $sql = "DELETE FROM aluno WHERE cpf = '$cpf'";
    mysqli_query($conn, $sql);
    if(mysqli_query($conn, $sql)){
        echo "<script> alert('Dados excuídos com sucesso!'); window.location = 'aluno.html' </script> ";
    }else{
        echo "Os dados não foram excluídos devido ao seguinte erro <br>". mysqli_error($conn);
    }
}



/*if(mysqli_query($conn, $sql)){
	echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'aluno.html' </script> ";
}else{
	echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
}

*/
mysqli_close($conn);
?>
