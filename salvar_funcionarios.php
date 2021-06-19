<?php
session_start();

$nome = $_POST["nome"];
$telefone = $_POST["telefone"];
$rua = $_POST["rua"];
$cpf = $_POST["cpf"];
$complemento = $_POST["complemento"];
$cep = $_POST["cep"];
$bairro = $_POST["bairro"];
$crmv = $_POST["crmv"];
$contrato = $_POST["contrato"];

// session
 //"$conexao" recebe a Conexão com o Banco de Dados
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");

	$sql = "UPDATE funcionario SET cep_funcionario = '". $cep ."',bairro_funcionario = '". $bairro ."', complemento_funcionario = '". $complemento ."', rua_funcionario = '". $rua ."', nome_funcionario = '". $nome ."', telefone_funcionario = '". $telefone ."' WHERE cpf_funcionario = ". $cpf .";";

	$res = pg_query($conexao, $sql);

	if($crmv != 0){
		$sql1 = "UPDATE veterinario SET crmv_veterinario = '". $crmv ."' WHERE cpf_funcionario = ". $cpf .";";
		$res1 = pg_query($conexao, $sql1);
	}
$_SESSION['message']="Os dados do funcionário foram alterados com sucesso!";
header('Location: mensagem_funcionarios.php');

?>