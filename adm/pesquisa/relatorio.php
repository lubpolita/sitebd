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

 <!--//////////////////////////////////////////////////////////////-->
    <!--Search Table -->
    <?php
    $cpf = $_POST['cpf'];    
    $option = $_POST['option'];   //pegando variável

    if ($option == 'aluno'){
        ?>
        <section class="page-section bg-primary" id="results">
        <div class="container h-100">
        <h2 class="text-uppercase text-white font-weight-bold text-center">Relatório: </h2>
        <table class="table">
        <thead class="table-hover">
        <tr>
            <th scope="col" class="text-white font-weight-bold text-center" >CPF</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nome</th>
            <th scope="col"class="text-white font-weight-bold text-center">Vencimento da Matrícula</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nascimento</th>
            <th scope="col"class="text-white font-weight-bold text-center">Endereço</th>
            <th scope="col"class="text-white font-weight-bold text-center">Sexo</th>
            <th scope="col"class="text-white font-weight-bold text-center">Horário Consulta</th>
            <th scope="col"class="text-white font-weight-bold text-center">CPF Nutri</th>
            <th scope="col"class="text-white font-weight-bold text-center">ID Turma</th>
            

            </tr>
        </thead>
    <tbody>

    <?php
        $search = "SELECT * FROM aluno WHERE cpf LIKE '$cpf'";
        $turma = "SELECT * FROM inscreve WHERE CPFAluno LIKE '$cpf'";
        $results = mysqli_query($conn, $search);
        $resultsTurma = mysqli_query($conn, $turma);
        
        $i = 0;
        while($row = mysqli_fetch_assoc($resultsTurma)){
            $aux[$i] = $row['idTurma'];
            $i++;
         }
 
         //caso não tenha turma
         if(!isset($aux)){
             $turmas = ' ';
         }
 
         //se tiver turma
         else{
             //transforma em string
        $turmas = implode(", ", $aux);
         }
        //tabela
        while ($row = mysqli_fetch_assoc($results)){
            ?>
            <tr>
            <th class="text-white font-weight-bold text-center"> <?php echo $row['CPF']; ?></th>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Nome']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Venc_Matricula']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Nascimento']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Endereco']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Sexo']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['HorarioConsulta']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['CPFNutricionista']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $turmas?></td>

         
            </tr>
        </div>
        <?php
        }
    }

    //opção professor
    else if ($option == 'prof'){
?>
        <section class="page-section bg-primary" id="results">
        <div class="container h-100">
        <h2 class="text-uppercase text-white font-weight-bold text-center">Relatório: </h2>
        <table class="table">
        <thead class="table-hover">
        <tr>
            <th scope="col" class="text-white font-weight-bold text-center" >CPF</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nome</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nascimento</th>
            <th scope="col"class="text-white font-weight-bold text-center">Salário</th>
            <th scope="col"class="text-white font-weight-bold text-center">Sexo</th>
            <th scope="col"class="text-white font-weight-bold text-center">Função</th>
            <th scope="col"class="text-white font-weight-bold text-center">ID das Turmas</th>
            

            </tr>
        </thead>
    <tbody>

    <?php
        $search = "SELECT * FROM funcionario WHERE fcpf LIKE '$cpf'";
        $results = mysqli_query($conn, $search);
        $turma = "SELECT * FROM turma WHERE CPFProf LIKE '$cpf'";
        $resultsTurma = mysqli_query($conn, $turma);
        $i = 0; //var auxiliar

        //pega turmas
        while($row = mysqli_fetch_assoc($resultsTurma)){
           $aux[$i] = $row['idTurma'];
           $i++;
        }

        //caso não tenha turma
        if(!isset($aux)){
            $turmas = 'não tem turma';
        }

        //se tiver turma
        else{
            //transforma em string
       $turmas = implode(", ", $aux);
        }
        
        //tabela
        while ($row = mysqli_fetch_assoc($results)){
            ?>
            <tr>
            <th class="text-white font-weight-bold text-center"> <?php echo $row['FCPF']; ?></th>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Nome']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Nascimento']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Salario']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Sexo']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['funcao']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $turmas; ?></td>
         
            </tr>
        </div>
        <?php
        }
    }
     //opção professor
     else if ($option == 'nutri'){
?>

<section class="page-section bg-primary" id="results">
        <div class="container h-100">
        <h2 class="text-uppercase text-white font-weight-bold text-center">Relatório: </h2>
        <table class="table">
        <thead class="table-hover">
        <tr>
            <th scope="col" class="text-white font-weight-bold text-center" >CPF</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nome</th>
            <th scope="col"class="text-white font-weight-bold text-center">Nascimento</th>
            <th scope="col"class="text-white font-weight-bold text-center">Salário</th>
            <th scope="col"class="text-white font-weight-bold text-center">Sexo</th>
            <th scope="col"class="text-white font-weight-bold text-center">Função</th>
            <th scope="col"class="text-white font-weight-bold text-center">Horários de Consulta</th>
            

            </tr>
        </thead>
    <tbody>

    <?php
        $search = "SELECT * FROM funcionario WHERE fcpf LIKE '$cpf'";
        $results = mysqli_query($conn, $search);
        $consultas = "SELECT * FROM aluno WHERE CPFNutricionista LIKE '$cpf'";
        $resultsConsultas = mysqli_query($conn, $consultas);
        $i = 0; //var auxiliar

        //pega turmas
        while($row = mysqli_fetch_assoc($resultsConsultas)){
           $aux[$i] = $row['HorarioConsulta'];
           $i++;
        }

        //caso não tenha turma
        if(!isset($aux)){
            $cons = 'não tem consultas';
        }

        //se tiver turma
        else{
            //transforma em string
       $cons = implode(", ", $aux);
        }
        
        //tabela
        while ($row = mysqli_fetch_assoc($results)){
            ?>
            <tr>
            <th class="text-white font-weight-bold text-center"> <?php echo $row['FCPF']; ?></th>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Nome']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Nascimento']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Salario']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['Sexo']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $row['funcao']; ?></td>
            <td class="text-white font-weight-bold text-center"> <?php echo $cons; ?></td>
         
            </tr>
        </div>
        <?php
        }
    }

    else{
        echo 'erro opção inválida.';
    }
?>

</tbody>

</div>
</section>

   
    </table>
	</body>
</html>