<?php
session_start();
// definindo variaveis e zerando valores
    $con = false;
    $query = "";  
    $queryErro="";  
    
   // if ($_SERVER['REQUEST_METHOD']== "POST") {
		      
		 $usuario = $_POST["usuario"];
		 $senha = $_POST["senha"];
		 echo ($usuario);
		 echo ($senha);
		// session

		$_SESSION['in']=0;
		$_SESSION['user']=0;
		$_SESSION['nome'] = 'Inválido';
		 //"$conexao" recebe a Conexão com o Banco de Dados
		
		//$conexao = pg_connect("host='localhost' dbname='ihc' user='root' password=''");
		$con = new MySQLi("localhost", "root", "", "ihc");
		//"$sql" string para Inserção de Registros na Tabela
 
		$sql = "SELECT c.cargo_contrato, f.nome_funcionario FROM funcionario f 
			LEFT OUTER JOIN contrato c ON f.id_contrato = c.id_contrato 
			WHERE f.cpf_funcionario = ". $senha ." 
			 AND f.id_contrato=". $usuario.";";
			//AND CURRENT_DATE BETWEEN inicio_contrato AND termino_contrato;";

		//"$res" recebe o resultado da Inserção
		//$res = pg_query($conexao, $sql);
		$resultado = $con->query($sql) or die($con->error);
		//"$qtd_linhas" recebe a quantidade de Linhas
		//$qtd_linhas = pg_affected_rows($res);


		//Se "$qtd_linhas" tiver um Valor maior que 0 
		//if ($qtd_linhas > 0)
		if($resultado->num_rows > 0)
		{
			$_SESSION['in']=1;
			//$consulta = pg_fetch_assoc($res);
			$consulta = $resultado->fetch_assoc();
			
			$cargo = $consulta['cargo_contrato'];
			$nome = $consulta['nome_funcionario'];
			$nome = explode(" ",$nome);
		  	$_SESSION['nome'] = $nome[0];

			if($cargo == "Atendente"){
				$_SESSION['user']=1;
			}
			if($cargo == "Vendedor"){
				$_SESSION['user']=2;
			}
			if($cargo == "Veterinário"){
				$_SESSION['user']=3;
			}
			if($cargo == "Gerente"){
				$_SESSION['user']=4;
			}
			
			header('Location: sistema.php');
		}
		//Se "$qtd_linhas" tiver um Valor Igual a 0 
		elseif ($resultado->num_rows == 0)
		{
			$_SESSION['in']=2;
			//header('Location: index.php');
		}

		?>