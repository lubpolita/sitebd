<?php
require_once("../conexao.php"); //criando conexão
?>

<html lang="pt-br">
	<head>
		<meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <link href="../../css/styles.css" rel="stylesheet" />
		<title>Resultados</title>		
	</head>
	<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="#page-top">FitPower</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item "><a class="nav-link js-scroll-trigger" href="../../index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../../alterar.html">Alterar</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../../cadastro.html">Cadastro</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../../pesquisa.html">Pesquisa</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../../listar.html">Listar</a></li>
                    </ul>
                </div>
            </div>
        </nav>


    <!--Search Table -->
    <section class="page-section bg-primary" id="results">
    <div class="container h-100">
    <h2 class="text-uppercase text-white font-weight-bold text-center">Resultados da sua Pesquisa por Turma: </h2>
    <table class="table">
        <thead class="table-hover">
             <tr>
            <th scope="col" class="text-white font-weight-bold text-center">ID da Turma</th>
            <th scope="col"class="text-white font-weight-bold text-center">Horário</th>
            <th scope="col"class="text-white font-weight-bold text-center">Modalidade</th>
            </tr>
        </thead>
    <tbody>

    <?php
    $idTurma = $_POST['idTurma'];    
    $horario = $_POST['horario'];  //pegando variável
    $option = $_POST['option'];
    $idMod = $_POST['idMod'];

    if($option == 'horario'){
        $searchHorario = "SELECT * FROM turma WHERE horario = '$horario'";
        $searchResultHorario = mysqli_query($conn, $searchHorario); 
        
        
    while($row = mysqli_fetch_assoc($searchResultHorario)){
        ?>
        <tr>
        <th class="text-white font-weight-bold text-center"> <?php echo $row['idTurma']; ?></th>
        <td class="text-white font-weight-bold text-center"> <?php echo $row['Horario']; ?></td>
        <td class="text-white font-weight-bold text-center"> <?php echo $row['idMod']; ?></td>
                    </tr>
    </div>
    <?php
        }
    }

    if($option == 'idTurma'){
        $searchId = "SELECT * FROM turma WHERE idTurma = '$idTurma'"; //realizando pesquisa
        $searchResultId= mysqli_query($conn, $searchId);

        while($row = mysqli_fetch_assoc($searchResultId)){
                ?>
             <tr>
                <th class="text-white font-weight-bold text-center"> <?php echo $row['idTurma']; ?></th>
                <td class="text-white font-weight-bold text-center"> <?php echo $row['Horario']; ?></td>
                <td class="text-white font-weight-bold text-center"> <?php echo $row['idMod']; ?></td>
                </tr>
            </div>
    <?php
            }
        }

    if ($option == 'modalidade'){
        $searchMod = "SELECT * FROM turma WHERE idMod ='$idMod'"; //realizando pesquisa
        $searchResultMod = mysqli_query($conn, $searchMod);
        
        while($row = mysqli_fetch_assoc($searchResultMod)){
                ?>
             <tr>
                <th class="text-white font-weight-bold text-center"> <?php echo $row['idTurma']; ?></th>
                <td class="text-white font-weight-bold text-center"> <?php echo $row['Horario']; ?></td>
                <td class="text-white font-weight-bold text-center"> <?php echo $row['idMod']; ?></td>
                </tr>
            </div>
            <?php
    }
}
    ?>


</tbody>
</div>
</section>

   
    </table>
	</body>
</html>