<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
 $id = $_GET["i"];
  $animal = $_GET["a"];
?>
<!DOCTYPE html>
<html>
<head>
<title>Petolavo 1.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body  bgcolor="#EEEEEE">
<div class="container">
	<div class="petolavo">Petolavo 1.0</div>
	
	<div class="box5">
		<input type="submit" onclick="location.href= 'cirurgias_a.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Marcar Cirurgia</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="add_cirurgias_a.php" method="POST" name="form_salvar">
			<div class="tabela_dados">
				<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">CPF Cliente</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="cpf" maxlength="11" size="50" style="height:27px;border: 1px solid #7f9db9; text-align:center;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Nome Cliente</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="cliente" maxlength="30" size="50" style="height:27px;border: 1px solid #7f9db9; text-align:center;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Nome Animal</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="animal" maxlength="30" size="50" style="height:27px;border: 1px solid #7f9db9; text-align:center;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Data</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="data" maxlength="10" size="12" style="height:27px;border: 1px solid #7f9db9; text-align:center;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Preço</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
								<input type="text" name="preco" maxlength="12" size="12" style="height:27px;border: 1px solid #7f9db9; text-align:center;" value="">
								</td>
							</tr>
					</table>	
				<div style="text-align:center; padding-top:1.0em;">
							<input type="submit" name="botao_salvar" maxlength="11" value="Marcar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;">
				</div>				
			</div>
		</form>	
	</div>
</div>
</body>
</html>