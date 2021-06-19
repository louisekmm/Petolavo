<?php
session_start();
$conexao = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=admin");
 $busca = $_POST["busca"];
$func = $_GET["i"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Petolavo 1.0</title>
<link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body  bgcolor="#EEEEEE">
<?php if($_SESSION['in'] != 1) header('Location: index.php');?>
<div class="container">
	<div class="petolavo">Petolavo 1.0</div>
	
	<div class="box5">
		<input type="submit" onclick="location.href= 'sistema.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Construção</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<?php 
	?>
	<div class="tabela_sis">
		<div><?php echo $_SESSION['nome'];?>, ainda estamos construindo essa página.</div><br>
		<div style="text-align:center;font-size:1.0em;font-weight: bold;">  Volte em breve!<div>
		 <div style="text-align:center; font-size:0.9em;color:#2a3d59;">
		 	<img src="images/construcao.jpg">
		</div>
	</div>
</div>
</body>
</html>