<?php
session_start();
$nome = $_POST["cliente"];
$cpf = $_POST["cpf"];
$nome_animal = $_POST["animal"];
$data = $_POST["data"];
$preco = $_POST["preco"];

$data = date('Y-m-d', strtotime($data));

 //"$conexao" recebe a Conexão com o Banco de Dados
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");

$sql1 = "SELECT cpf_cliente from cliente where cpf_cliente = '". $cpf ."';"; 
$res1 = pg_query($conexao, $sql1);
$qtd_linhas = pg_affected_rows($res1);

if($qtd_linhas == 0){
	$sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, nasc_cliente, rua_cliente, cep_cliente, complemento_cliente, bairro_cliente, telefone_cliente) values('padrao', '". $cpf ."', current_date, '". $nome."', '11111111', 'padrao', 'padrao', '11111111');";
	$res = pg_query($conexao, $sql);

	$sql = "INSERT INTO animal (nome_animal, nasc_animal, id_raca,cpf_cliente) values('".$nome_animal."', current_date, '1', '".$cpf."');";
	$res = pg_query($conexao, $sql);

	$sql = "SELECT id_animal from animal where cpf_cliente = '". $cpf ."';"; 
	$res = pg_query($conexao, $sql);
	$consulta = pg_fetch_assoc($res);
	$id_animal = $consulta['id_animal'];

	$sql1 = "INSERT INTO historico_medico (id_animal) values('".$id_animal."');";
	$res1 = pg_query($conexao, $sql1);
}

	$sql2 = "SELECT id_animal from animal where cpf_cliente = '". $cpf ."' AND nome_animal ='".$nome_animal."';"; 
	$res2 = pg_query($conexao, $sql2);
	$consulta2 = pg_fetch_assoc($res2);
	$id_animal2 = $consulta2['id_animal'];

	$sql3 = "SELECT id_historico from historico_medico where id_animal = '". $id_animal2 ."';"; 
	$res3 = pg_query($conexao, $sql3);
	$consulta3 = pg_fetch_assoc($res3);
	$id_historico3 = $consulta3['id_historico'];

	$sql4 = "INSERT INTO cirurgia (preco_cirurgia, desc_cirurgia, data_cirurgia, id_historico) values('".$preco."', 'Agendada', '".$data."', '".$id_historico3."');";
	$res4 = pg_query($conexao, $sql4);

$_SESSION['message']="Cirurgia marcada com sucesso!";
header('Location: mensagem_cirurgias_a.php');

?>