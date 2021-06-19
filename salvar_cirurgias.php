<?php
session_start();
 $id = $_POST["id"];
 $desc = $_POST["desc"];
 $data = $_POST["data"];
$data = date('Y-m-d', strtotime($data));

// session
 //"$conexao" recebe a Conexão com o Banco de Dados
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");

if($desc == '') $desc = 'Agendada';
//"$sql" string para Inserção de Registros na Tabela
$sql = "UPDATE cirurgia SET desc_cirurgia = '". $desc ."', data_cirurgia = '". $data ."' WHERE id_cirurgia = ". $id .";";

//"$res" recebe o resultado da Inserção
$res = pg_query($conexao, $sql);
$_SESSION['message']="Descrição da cirurgia salva com sucesso!";
header('Location: mensagem_cirurgias.php');

?>