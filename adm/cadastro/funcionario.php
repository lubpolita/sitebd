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
$funcao = $_POST['funcao'];

#var para comparação
$professor = 'professor';
$nutri = 'nutricionista';


#inserindo em funcionário
$sql = "INSERT INTO funcionario (fcpf, nome, salario, nascimento, sexo, funcao)
VALUES('$fcpf', '$nome', '$salario', '$nascimento', '$sexo', '$funcao')";


mysqli_query($conn, $sql);

 #determinando se é professor ou nutricionista
if (strcmp($funcao, $professor) == 0){
    $sqlfunc = "INSERT INTO professor (pcpf) VALUES ('$fcpf')";
    if(mysqli_query($conn, $sqlfunc)){
        echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'funcionario.html' </script> ";
    }else{
        echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
    }
    
}
else if (strcmp($funcao, $nutri) == 0){
    $sqlfunc = "INSERT INTO nutricionista(ncpf) VALUES ('$fcpf')";
    if(mysqli_query($conn, $sqlfunc)){
        echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'funcionario.html' </script> ";
    }else{
        echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
    }
}
else{
    echo "Insira uma função válida.";
}


mysqli_close($conn);
?>