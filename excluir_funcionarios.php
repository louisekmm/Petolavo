<?php
session_start();
$id = $_GET["i"];
// session
 //"$conexao" recebe a Conexão com o Banco de Dados
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
 	
$data = date('Y/m/d', strtotime('-2 days', strtotime(date('Y-m-d'))));

//"$sql" string para Inserção de Registros na Tabela
$sql1 = "SELECT funcionario.id_contrato FROM funcionario WHERE funcionario.cpf_funcionario=". $id ." ;";

$res1 = pg_query($conexao, $sql1);
$consulta1 = pg_fetch_assoc($res1);

$sql = "UPDATE contrato SET termino_contrato = '". $data ."' WHERE id_contrato = ". $consulta1['id_contrato'] .";";
$res = pg_query($conexao, $sql);

$_SESSION['message']="Exclusão efetuada com sucesso! O funcionário não está mais ativo e seu contrato foi finalizado.";

header('Location: mensagem_funcionarios.php');

?>