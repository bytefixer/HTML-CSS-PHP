<!doctype html>
<html lang="pt-br">
	<head>
		<title>Gravação de Formulário</title>
		<meta charset="UTF-8">
	</head>
	<body>
	<?php
        
		$nome 			= $_POST["nome"] ;
		$email 			= $_POST["email"] ;
        $DDD            = $_POST["DDD"] ;
        $telefone       = $_POST["telefone"] ;
        $dataNasc       = $_POST["dataNasc"] ;
		$sexo 			= $_POST["sexo"] ;
        $estadoCivil    = $_POST["estadoCivil"] ;
        $dataAgen       = $_POST["dataAgen"] ;
        $horaAgen       = $_POST["horaAgen"] ;
        $numero         = $_POST["numero"] ;
		$fotos          = $_FILES["fotos"] ;
		$checkbox		= $_POST["checkbox"] ;
        $Descricao      = $_POST["Descricao"] ;
		

		$fotos 			= $_FILES["fotos"]["name"] ;
		$tamanho 		= $_FILES["fotos"]["size"] ;
		$tipoArquivo	= $_FILES["fotos"]["type"] ;
		$nomeTmp 		= $_FILES["fotos"]["tmp_name"] ;

        echo"<hr>";

		echo "<h1>• Gravando os dados do formulário...</h1>";

		echo "<b>○ Nome:</b> $nome <br>";
		echo "<b>○ Email:</b> $email <br>";
		echo "<b>○ DDD: </b>$DDD <br>";
		echo "<b>○ Telefone:</b>  $telefone <br>";
		echo "<b>○ Data de Nascimento:</b> $dataNasc <br>";	
		echo "<b>○ Sexo: </b>$sexo <br>";
		echo "<b>○ Estado Civil:</b> $estadoCivil <br>";
		echo "<b>○ Data do Agendamento:</b> $dataAgen <br>";
		echo "<b>○ Hora do Agendamento:</b> $horaAgen <br>";
		echo "<b>○ Número da Carteirinha:</b> $numero <br>";
		echo "<b>○ Tem alguma doença crônica?:</b> $checkbox <br>";
		echo "<b>○ Descrição:</b> $Descricao <br>";

        echo"<hr>";

        echo "<h2>• Arquivos enviados</h2>";

        $destino = "arquivos\\";
		if(isset($_POST['submit']))
        {
            
            $countfiles = count($_FILES['fotos']['name']);
           
            for($i = 0; $i < $countfiles; $i++){
             $filename = $fotos[$i];
             $filesize = $tamanho[$i];
             $filetype = $tipoArquivo[$i];
             $fileTmp = $nomeTmp[$i];

             echo "<b>○ Nome:</b> $filename <br>";
             echo "<b>○ Tamanho:</b> $filesize bytes <br>";
             echo "<b>○ Tipo:</b> $filetype <br>";
             echo "<b>○ Nome Temporario:</b> $fileTmp <br>";

             echo "<b>○ Movendo arquivo de</b> $filename <b>para</b> $destino<br><br>";
             
             move_uploaded_file($fileTmp,'arquivos\\'.$filename);
            
            }
        }

        $conn = mysqli_connect("localhost", "root", "");
        mysqli_set_charset($conn, "utf8");

        echo"<hr>";

		mysqli_select_db($conn,"aluno1730364272") or
			die("Erro ao abrir o banco de dados:<br>" .
				mysqli_error($conn)
			);

            $sql="
		    INSERT INTO cadastro(nome, 
            email, 
            DDD, 
            telefone, 
            dataNasc, 
            sexo, 
            estadoCivil, 
            dataAgen, 
            horaAgen, 
            numero,
            fotos,
            checkbox,
            Descricao) 
		            VALUES(
						'$nome', 
						'$email', 
						'$DDD', 
						'$telefone', 
						'$dataNasc', 
						'$sexo', 
						'$estadoCivil', 
						'$dataAgen', 
						'$horaAgen', 
						'$numero',
                        '$filename',
                        '$checkbox',
                        '$Descricao');";

			if(mysqli_query($conn, $sql)) {
               echo "Paciente <b>$nome</b> cadastrado(a) com sucesso!<hr>";
           }
           else {
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
       }
       //Teste de conexao
       // if($conn->connect_error)
        // {
        //     echo "erro";
        // }
        // else
        // {
        //     echo "Conectado ao banco de dados";
        // }

	?>
	</body>
</html>
