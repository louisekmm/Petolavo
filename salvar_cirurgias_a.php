<?php
session_start();
 $id = $_POST["id"];
 $data = $_POST["data"];
 $data = date('Y-m-d', strtotime($data));
  $preco = $_POST["preco"];

// session
 //"$conexao" recebe a Conexão com o Banco de Dados
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");

$desc = 'Agendada';
//"$sql" string para Inserção de Registros na Tabela
$sql = "UPDATE cirurgia SET desc_cirurgia = '". $desc ."', preco_cirurgia = '". $preco ."',data_cirurgia = '". $data ."' WHERE id_cirurgia = ". $id .";";

//"$res" recebe o resultado da Inserção
$res = pg_query($conexao, $sql);
$_SESSION['message']="Cirurgia agendada com sucesso!";
header('Location: mensagem_cirurgias_a.php');

?>