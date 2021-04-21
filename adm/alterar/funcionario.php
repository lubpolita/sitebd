<?php

require_once("../conexao.php");

if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

#recebendo variáveis
$nome = $_POST['nome'];
$fcpf = $_POST['fcpf'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
$salario = $_POST['salario'];
$option = $_POST['option'];

if ($option == 'alterar'){

  $sql =

  "UPDATE funcionario
  SET fcpf = '$fcpf', nome = '$nome', salario = $salario, nascimento = '$nascimento', sexo = '$sexo'
  WHERE fcpf = '$fcpf'";


  if(mysqli_query($conn, $sql)){
    echo "<script> alert('funcionario alterado com sucesso!'); window.location = 'aluno.html' </script> ";
  }else{
    echo "Os dados não foram alterados devido ao seguinte erro <br>". mysqli_error($conn);
  }

}

else if ($option == 'excluir'){
  #echo 'opção excluir';
  $sql = "DELETE FROM funcionario WHERE fcpf = '$fcpf'";
  mysqli_query($conn, $sql);
  if(mysqli_query($conn, $sql)){
    echo "<script> alert('Dados excuídos com sucesso!'); window.location = 'aluno.html' </script> ";
  }else{
    echo "Os dados não foram excluídos devido ao seguinte erro <br>". mysqli_error($conn);
  }
}


mysqli_close($conn);
?>
