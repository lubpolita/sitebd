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
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="../../listar.html">Pesquisa</a></li>
                    </ul>
                </div>
            </div>
        </nav>


    <!--Search Table -->
    <section class="page-section bg-primary" id="results">
    <div class="container h-100">
    <h2 class="text-uppercase text-white font-weight-bold text-center">Resultados da sua Pesquisa por Modalidade: </h2>
    <table class="table">
        <thead class="table-hover">
             <tr>
            <th scope="col" class="text-white font-weight-bold text-center">ID</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nome</th>
            </tr>
        </thead>
    <tbody>
    <?php
    $nome = $_POST['nome'];    
    $idMod = $_POST['idMod'];   //pegando variável

    $searchNome = "SELECT * FROM modalidade WHERE nomeMod LIKE '$nome'"; //realizando pesquisa
    $searchId = "SELECT * FROM modalidade WHERE idMod2 LIKE '$idMod'";
    $searchResultNome = mysqli_query($conn, $searchNome);
    $searchResultId = mysqli_query($conn, $searchId);                  //resultados da pesq    
    
    while($row = mysqli_fetch_assoc($searchResultNome)){

            ?>
            <tr>
            <th class="text-white font-weight-bold text-center"> <?php echo $row['idMod2']; ?></th>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['nomeMod']; ?></td>
                        </tr>
        </div>
        <?php
        }
        while($row = mysqli_fetch_assoc($searchResultId)){
            ?>
         <tr>
            <th class="text-white font-weight-bold text-center"> <?php echo $row['idMod2']; ?></th>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['nomeMod']; ?></td>
            </tr>
        </div>
<?php
        }

?>

</tbody>

</div>
</section>

   
    </table>
	</body>
</html>