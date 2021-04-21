<?php
require_once("../conexao.php");

$idturma = $_POST['idturma'];
$horario = $_POST['horario'];
$cpfprof = $_POST['cpf_prof'];
$nomemod = $_POST['nome'];
$option = $_POST['option'];

if ($option == 'alterar'){

  $sql =

  "UPDATE turma
  SET idturma = '$idturma', horario = '$horario', cpfprof = '$cpfprof', idmod = '$nomemod'
  WHERE idturma = '$idturma'";  

  if(mysqli_query($conn, $sql)){
    echo "<script> alert('turma alterada com sucesso!'); window.location = 'aluno.html' </script> ";
  }else{
    echo "Os dados não foram alterados devido ao seguinte erro <br>". mysqli_error($conn);
  }

}

else if ($option == 'excluir'){
    $sql = "DELETE FROM turma WHERE idTurma = '$idturma'";
    mysqli_query($conn, $sql);
    if(mysqli_query($conn, $sql)){
        echo "<script> alert('Dados excuídos com sucesso!'); window.location = 'aluno.html' </script> ";
    }else{
        echo "Os dados não foram excluídos devido ao seguinte erro <br>". mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
