<?php 

#conexao
require_once("../conexao.php"); 
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

#var 
$cpfAluno = $_POST['cpfAluno'];
$idTurma = $_POST['idTurma']; 


$search = "SELECT * FROM turma WHERE idturma = $idTurma"; //realizando pesquisa
$searchResult = mysqli_query($conn, $search);           //resultados da pesq    

while($row = mysqli_fetch_assoc($searchResult)){
    $aux = $row['numeroaluno'];
}

if($aux < 15){
$sqlxam =
"UPDATE turma
  SET numeroaluno = $aux+1
  WHERE idturma = $idTurma";
  
mysqli_query($conn, $sqlxam);
  
#inserindo 
$sql = "INSERT INTO inscreve (CPFAluno, idTurma) VALUES('$cpfAluno', '$idTurma')";

if(mysqli_query($conn, $sql)){
	echo "<script> alert('Dados cadastrados com sucesso!'); window.location = 'modalidade.html' </script> ";
}else{
	echo "Os dados não foram cadastrados devido ao seguinte erro <br>". mysqli_error($conn);
}

} 
else {
    echo "<script> alert('Turma cheia!'); window.location ='inscrever.html' </script>";
}




mysqli_close($conn);
?>