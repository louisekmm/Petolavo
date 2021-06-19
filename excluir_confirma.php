<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
 $busca = $_POST["busca"];
$func = $_GET["i"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Petolavo 1.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body  bgcolor="#EEEEEE">
<?php if($_SESSION['in'] != 1) header('Location: index.php');?>
<div class="container">
	<div class="petolavo">Petolavo 1.0</div>
	
	<div class="box5">
		<input type="submit" onclick="location.href= 'funcionarios.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Confirmar exclusão</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<?php 
	$sql = "SELECT funcionario.nome_funcionario FROM funcionario WHERE funcionario.cpf_funcionario=". $func ." ;";

	$res = pg_query($conexao, $sql);
	$consulta = pg_fetch_assoc($res);
	?>
	<div class="tabela_sis">
		<div><?php echo $_SESSION['nome'];?>, você realmente quer deletar o funcionário abaixo?</div><br>
		 <div style="text-align:center; font-size:0.9em;color:#2a3d59;">
		 	<table border="1" cellspacing="0" cellpadding="30" align="center" bordercolor="999aff"><tr><td><b>
		 	CPF:</b> <?php echo $func;?><br>
		 	<b>Nome: </b><?php echo $consulta['nome_funcionario'];?>
		 </td></tr></table>
		 </div>
		 <br><br>
		<div style="padding-left: 9.0em;font-size:0.9em;position:relative;width:40%;float:left;text-align:left;">
			<a style="font-weight: bold; text-align:left;" href="excluir_funcionarios.php?i=<?php echo $func; ?>">Confirmar</a>
		</div>
		<div style="text-align: right;padding-right: 9.0em;">
			<a href="funcionarios.php" style="font-weight: bold;">Cancelar</a>
		</div>
	</div>
</div>
</body>
</html>