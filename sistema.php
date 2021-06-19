<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>Petolavo 1.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body  bgcolor="#EEEEEE">
<?php
	if($_SESSION['in'] != 1) header('Location: index.php');
	?>
<div class="container">
	<div class="petolavo">Petolavo 1.0</div>
	
	<div style="text-align: right;padding-right: 1.7em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box4" style="padding-bottom:0.2;font-weight: bold;">Seja bem-vindo(a), <?php echo $_SESSION['nome'];?>!</div>
	<div style="text-align: right;padding-right: 1.7em; padding-bottom:0.2em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
	<?php if($_SESSION['user']==1){ ?>
	<table align="center" width="90%" style="font-weight: bold;">
			<tr>
				<td width="22,5%"><a href = "construcao.php"><img src="images/icone_cliente.png"></a></td>
				<td width="22,5%"><a href = "construcao.php"><img src="images/icone_animal.png"></a></td>
				<td width="22,5%"><a href = "construcao.php"><img src="images/icone_consulta.png"></a></td>
				<td width="22,5%"><a href = "construcao.php"><img src="images/icone_servico.png"></a></td>
			</tr>
			<tr>
				<td><a href = "construcao.php" class="nsublinhado">Clientes</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Animais</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Consultas</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Serviços</a></td>
			</tr>
		</table><br>
		<table align="center" width="90%" style="font-weight: bold;">
			<tr>
				<td width="30%"><a href = "cirurgias_a.php"><img src="images/icone_cirurgia.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_vacina.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_gestao.png"></a></td>
			</tr>
			<tr>
				<td><a href = "cirurgias_a.php" class="nsublinhado">Cirurgias</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Vacinas</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Gestão</a></td>
			</tr>
		</table>
		<?php } ?>

		<?php if($_SESSION['user']==3){ ?>
		<table align="center" width="90%" style="font-weight: bold;">
			<tr>
				<td width="30%"><a href = "cirurgias.php"><img src="images/icone_cirurgia.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_consulta.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_gestao.png"></a></td>
			</tr>
			<tr>
				<td><a href = "cirurgias.php" class="nsublinhado" >Cirurgias</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Consultas</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Gestão</a></td>
			</tr>
		</table>
		<?php } ?>

		<?php if($_SESSION['user']==2){ ?>
		<table align="center" width="90%" style="font-weight: bold;">
			<tr>
				<td width="30%"><a href = "vendas.php"><img src="images/icone_venda.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_estoque.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_gestao.png"></a></td>
			</tr>
			<tr>
				<td><a href = "vendas.php" class="nsublinhado">Vendas</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Estoque</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Gestão</a></td>
			</tr>
		</table>
		<?php } ?>

		<?php if($_SESSION['user']==4){ ?>
		<table align="center" width="90%" style="font-weight: bold;">
			<tr>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_produto.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_animal.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_servico.png"></a></td>
			</tr>
			<tr>
				<td><a href = "construcao.php" class="nsublinhado">Produtos</a><br><br></td>
				<td><a href = "construcao.php" class="nsublinhado">Raças</a><br><br></td>
				<td><a href = "construcao.php" class="nsublinhado">Serviços</a><br><br></td>
			</tr>
			<tr>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_vacina.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_contrato.png"></a></td>
				<td width="30%"><a href = "funcionarios.php"><img src="images/icone_funcionario.png"></a></td>
			</tr>
			<tr>
				<td><a href = "construcao.php" class="nsublinhado">Vacinas</a><br><br></td>
				<td><a href = "construcao.php" class="nsublinhado">Tarefas</a><br><br></td>
				<td><a href = "funcionarios.php" class="nsublinhado">Funcionários</a><br><br></td>
			</tr>
			<tr>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_parceiro.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_fornecedor.png"></a></td>
				<td width="30%"><a href = "construcao.php"><img src="images/icone_gestao.png"></a></td>
			</tr>
			<tr>
				<td><a href = "construcao.php" class="nsublinhado">Parceiros</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Fornecedores</a></td>
				<td><a href = "construcao.php" class="nsublinhado">Gestão</a></td>
			</tr>
			<tr><td colspan="3"><br>
				<input type="submit" name="botao_salvar" onclick="location.href= 'construcao.php'" maxlength="11" value="Relatório Mensal" style="width:150px; height:35px;border: 2px solid #7f9db9;border-radius:3px;">
				</td>
			</tr>
		</table>
		<?php }?>
	</div>
</div>
</body>
</html>