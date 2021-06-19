<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
 $id = $_GET["i"];
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
		<input type="submit" onclick="location.href= 'funcionarios.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Alteração de Funcionário</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="salvar_funcionarios.php" method="POST" name="form_salvar">
			
			<?php
				$sql = "SELECT funcionario.id_contrato, contrato.salario_contrato, contrato.cargo_contrato, funcionario.nome_funcionario, funcionario.cpf_funcionario, funcionario.telefone_funcionario, funcionario.rua_funcionario, funcionario.complemento_funcionario, funcionario.cep_funcionario, funcionario.bairro_funcionario, funcionario.veterinario
					FROM funcionario,contrato WHERE contrato.id_contrato = funcionario.id_contrato AND funcionario.cpf_funcionario=". $id .";";	
				$res = pg_query($conexao, $sql);
				$qtd_linhas = pg_affected_rows($res);

				$sql1 = "SELECT veterinario.crmv_veterinario FROM veterinario WHERE veterinario.cpf_funcionario=". $id ." ;";
				$res1 = pg_query($conexao, $sql1);
				$qtd_linhas1 = pg_affected_rows($res1);
				$consulta1 = pg_fetch_assoc($res1);

			?>
			<div class="tabela_dados">
				<?php if ($qtd_linhas > 0){ ?>	
					<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
						<?php while($linha = pg_fetch_array($res)){	?>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Nome</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="nome" maxlength="30" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['nome_funcionario']);?>">
									<input type="hidden" name="cpf" value="<?php echo ($linha['cpf_funcionario']);?>">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Telefone</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="telefone" maxlength="9" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['telefone_funcionario']);?>">
								</td>
							</tr>
														<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Endereço</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="rua" maxlength="30" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['rua_funcionario']);?>">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Complemento</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="complemento" maxlength="15" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['complemento_funcionario']);?>">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">CEP</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="cep" maxlength="8" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['cep_funcionario']);?>">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Bairro</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="bairro" maxlength="15" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['bairro_funcionario']);?>">
								</td>
							</tr>
							<?php if ($qtd_linhas1 > 0){ ?> 
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">CRMV</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
								<input type="text" name="crmv" maxlength="5" size="60" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($consulta1['crmv_veterinario']);?>">
								</td>
							</tr>
							<?php } else{?>
									<input type="hidden" name="crmv" value="0">
							<?php } ?>
							
							<?php }?>
					</table>	
				<?php }?>
				<div style="text-align:center; padding-top:1.0em;">
							<input type="submit" name="botao_salvar" maxlength="11" value="Salvar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;">
							<input type="hidden" name="id" value="<?php echo $id;?>">

				</div>	<br>
			</div>
		</form>	
	</div>
</div>
</body>
</html>