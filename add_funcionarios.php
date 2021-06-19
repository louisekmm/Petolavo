<?php
session_start();
$nome = $_POST["nome"];
$cpf = $_POST["cpf"];
$telefone = $_POST["telefone"];
$rua = $_POST["rua"];
$complemento = $_POST["complemento"];
$cep = $_POST["cep"];
$bairro = $_POST["bairro"];
$crmv = $_POST["crmv"];
$salario = '1000';
$cargo = $_POST["cargo"];

$ini_ferias = date('Y/m/d', strtotime('+12 months', strtotime(date('Y-m-d'))));
$term_ferias = date('Y/m/d', strtotime('+13 months', strtotime(date('Y-m-d'))));
$term_contrato = date('Y/m/d', strtotime('+2 years', strtotime(date('Y-m-d'))));

 //"$conexao" recebe a Conexão com o Banco de Dados
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");

$sql = "INSERT INTO contrato (salario_contrato, inicio_contrato, inicio_ferias_contrato, fim_ferias_contrato, termino_contrato, cargo_contrato) values('". $salario ."',current_date, '". $ini_ferias ."', '". $term_ferias ."', '". $term_contrato ."', '". $cargo ."');";
$res = pg_query($conexao, $sql);


$sql3 = "SELECT id_contrato from contrato order by id_contrato desc limit 1;"; 
$res3 = pg_query($conexao, $sql3);
$consulta3 = pg_fetch_assoc($res3);
$contrato_id = $consulta3['id_contrato'];

if($crmv == NULL){
	$sql1 = "INSERT INTO funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario, rua_funcionario, complemento_funcionario, cep_funcionario, bairro_funcionario, veterinario, administrativo, id_contrato) values('". $nome ."', '". $cpf ."', '". $telefone ."', '". $rua ."', '". $complemento ."', '". $cep ."', '". $bairro ."', null, '". $cpf ."', '". $contrato_id ."');";
	$res1 = pg_query($conexao, $sql1);

	$sql2 = "INSERT INTO administrativo(cpf_funcionario) values('". $cpf ."');";
	$res2 = pg_query($conexao, $sql2);

}else{

	$sql1 = "INSERT INTO funcionario (nome_funcionario, cpf_funcionario, telefone_funcionario, rua_funcionario, complemento_funcionario, cep_funcionario, bairro_funcionario, veterinario, administrativo, id_contrato) values('". $nome ."', '". $cpf ."', '". $telefone ."', '". $rua ."', '". $complemento ."', '". $cep ."', '". $bairro ."', '". $cpf ."', null, '". $contrato_id ."');";
	$res1 = pg_query($conexao, $sql1);

	$sql2 = "INSERT INTO veterinario(cpf_funcionario, crmv_veterinario, especialidade_veterinario, escolaridade_veterinario) values('". $cpf ."', '". $crmv ."', '". $cargo ."', 'A');";
	$res2 = pg_query($conexao, $sql2);
}

$_SESSION['message']="O funcionário foi criado com sucesso!";
header('Location: mensagem_funcionarios.php');

?>