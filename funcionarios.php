<?php
session_start();
$conexao = new MySQLi("localhost", "root", "", "ihc");
 $busca = $_POST["busca"];
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
		<input type="submit" onclick="location.href= 'sistema.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Gerenciamento de Funcionários</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		<form action="funcionarios.php" method="POST" name="form_busca">
			<div style="text-align:left;padding-left:2.2em;position:relative;width:50%;float:left;">
				<input type="text" name="busca" value="Nome" maxlength="30" size="45" style="height:27px;color:gray;border: 1px solid #7f9db9;">
				<input type="submit" name="botao_busca" maxlength="11" value="Procurar" style="height:35px;border: 1px solid #7f9db9;border-radius:3px;">
			</div>
		</form>
			<div style="text-align: right;padding-right: 1.0em;">
				<input type="submit" onclick="location.href= 'adicionar_funcionarios.php'" name="botao_adicionar" maxlength="13" value="Adicionar Funcionário" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;background-color: #dbdbdb">
			</div>
			
			<br>

			<?php
			
				if ($busca == ''){
				$sql = "SELECT funcionario.cpf_funcionario,funcionario.nome_funcionario, funcionario.telefone_funcionario, contrato.inicio_contrato, contrato.cargo_contrato, veterinario.crmv_veterinario  FROM contrato, funcionario 
						LEFT OUTER JOIN veterinario ON funcionario.cpf_funcionario = veterinario.cpf_funcionario 
						WHERE contrato.id_contrato = funcionario.id_contrato AND current_date BETWEEN inicio_contrato AND termino_contrato order by funcionario.nome_funcionario asc; ";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
				else{
					$sql = "SELECT funcionario.cpf_funcionario,funcionario.nome_funcionario, funcionario.telefone_funcionario, contrato.inicio_contrato, contrato.cargo_contrato, veterinario.crmv_veterinario  FROM contrato, funcionario
					LEFT OUTER JOIN veterinario ON funcionario.cpf_funcionario = veterinario.cpf_funcionario 
					WHERE contrato.id_contrato = funcionario.id_contrato AND current_date BETWEEN inicio_contrato AND termino_contrato AND
					funcionario.nome_funcionario ilike '%". $busca ."%' order by funcionario.nome_funcionario asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
			?>
			<div class="tabela_dados">
				<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
				<?php if ($qtd_linhas > 0){ ?>
							<tr style="height:60px; background-color: #CCC;font-weight: bold;">
								<td style="border: 1px solid #7f9db9;" width="10%">Editar</td>
								<td style="border: 1px solid #7f9db9;" width="10%">Excluir</td>
								<td style="border: 1px solid #7f9db9;" width="17%">Nome</td>
								<td style="border: 1px solid #7f9db9;" width="16%">Telefone</td>
								<td style="border: 1px solid #7f9db9;" width="19%">Cargo</td>
								<td style="border: 1px solid #7f9db9;" width="15%">Início Contrato</td>
								<td style="border: 1px solid #7f9db9;" width="13%">CRMV</td>
							</tr>

				<?php		while($linha = pg_fetch_array($res)){ ?>		
								<tr style="height:50px;">
									<td style="border: 1px solid #7f9db9;">
									<a href="incluir_funcionarios.php?i=<?php echo $linha['cpf_funcionario']; ?>">
												<img src="images/icone_edit.png" height="33" width="33">
									</a></td>
									<td style="border: 1px solid #7f9db9;">
									<a href="excluir_confirma.php?i=<?php echo $linha['cpf_funcionario']; ?>">
												<img src="images/icone_del.png" height="33" width="33">
									</a></td>
									<td style="border: 1px solid #7f9db9;" ><?php echo $linha['nome_funcionario']; ?></td>
									<td style="border: 1px solid #7f9db9;" ><?php echo $linha['telefone_funcionario']; ?></td>
									<td style="border: 1px solid #7f9db9;"><?php echo $linha['cargo_contrato']; ?></td>
									<td style="border: 1px solid #7f9db9;"><?php echo date('d-m-Y', strtotime($linha['inicio_contrato'])); ?></td>
									<td style="border: 1px solid #7f9db9;">
									<?php if ($linha['crmv_veterinario'] == NULL){
												echo "Não tem";
											}else{
												echo ($linha['crmv_veterinario']);
											}
									 ?></td>
								</tr>
							<?php }
					} 
				    elseif ($qtd_linhas == 0){ ?>
					<tr>
						<td style="color: red;">Não há resultados.</td>
					</tr>
				<?php } ?>
		</table>
			</div>
	</div>
</div>
</body>
</html>