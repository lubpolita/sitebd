<?php

require_once("../conexao.php");


if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

#recebendo variáveis
$newName = $_POST['newName'];
$oldName = $_POST['oldName'];
$option = $_POST['option'];

if ($option == 'alterar'){

  $sql =

  "UPDATE modalidade
  SET nomemod = '$newName'
  WHERE nomemod = '$oldName'";

  if(mysqli_query($conn, $sql)){
    echo "<script> alert('funcionario alterado com sucesso!'); window.location = 'aluno.html' </script> ";
  }else{
    echo "Os dados não foram alterados devido ao seguinte erro <br>". mysqli_error($conn);
  }
}

else if ($option == 'excluir'){
  $sql = "DELETE FROM modalidade WHERE nomeMod = '$oldName'";
  mysqli_query($conn, $sql);
  if(mysqli_query($conn, $sql)){
    echo "<script> alert('Dados excuídos com sucesso!'); window.location = 'aluno.html' </script> ";
  }else{
    echo "Os dados não foram excluídos devido ao seguinte erro <br>". mysqli_error($conn);
  }
}


mysqli_close($conn);
?>
