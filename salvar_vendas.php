<?php
session_start();
 $cpf = $_POST["cpff"];

$qtd = $_POST["qtdes"];
$i = 0;
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");

$sql1 = "SELECT cpf_cliente from cliente where cpf_cliente = '". $cpf ."';"; 
$res1 = pg_query($conexao, $sql1);
$qtd_linhas = pg_affected_rows($res1);

if($qtd_linhas == 0){
	$sql = "INSERT INTO cliente (nome_cliente, cpf_cliente, nasc_cliente, rua_cliente, cep_cliente, complemento_cliente, bairro_cliente, telefone_cliente) values('padrao', '". $cpf ."', current_date, 'padrao', '11111111', 'padrao', 'padrao', '11111111');";
	$res = pg_query($conexao, $sql);
}
	
foreach($_POST['ids'] as $id_prod){
	
	if($qtd[$i]>1){
		for($j=1; $j<=$qtd[$i];$j++){
			$sql2 = "INSERT INTO compra (id_produto, data_compra, cpf_cliente) values('". $id_prod ."', current_date, '". $cpf ."');";
			$res2 = pg_query($conexao, $sql2);
		}
	}
	else{
		$sql2 = "INSERT INTO compra (id_produto, data_compra, cpf_cliente) values('". $id_prod ."', current_date, '". $cpf ."');";
		$res2 = pg_query($conexao, $sql2);
	}
	$sql3 = "SELECT estoque_produto from produto where id_produto = '". $id_prod ."';"; 
	$res3 = pg_query($conexao, $sql3);
	$consulta = pg_fetch_assoc($res3);
	$estoque = $consulta['estoque_produto'];

	$estoque_final = $estoque - $qtd[$i];

	$sql4 = "UPDATE produto SET estoque_produto = '". $estoque_final ."' WHERE id_produto = ". $id_prod .";";
	$res4 = pg_query($conexao, $sql4);
	$i = $i+1;
}

$_SESSION['message']="Venda realizada com sucesso!";
header('Location: mensagem_vendas.php');

?>