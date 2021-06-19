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
	<div class="box6">Cadastro de Funcionário</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="add_funcionarios.php" method="POST" name="form_salvar">
			
			<div class="tabela_dados">
					<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Nome</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="nome" maxlength="30" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">CPF</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="cpf" maxlength="11" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Telefone</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="telefone" maxlength="9" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
														<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Endereço</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="rua" maxlength="30" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Complemento</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="complemento" maxlength="15" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">CEP</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="cep" maxlength="8" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Bairro</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="bairro" maxlength="15" size="60" style="height:27px;border: 1px solid #7f9db9;" value="">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Cargo</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<select name="cargo" style="height:27px;border: 1px solid #7f9db9;">
									  
									  <option value="Atendente">Atendente</option>
									  <option value="Gerente" >Gerente</option>
									  <option value="Vendedor">Vendedor</option>
									  <option value="Veterinário">Veterinário</option>
									</select> 
								</td>
							</tr>
							<tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:60px;font-weight: bold;" width="40%">CRMV</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<input type="text" name="crmv" maxlength="5" size="60" style="border: 1px solid #7f9db9; height:20px;" value=""><br>
									<div style="color:red; text-align:left;">*Digitar CRMV somente para veterinários!</div>
								</td>
							</tr>
					</table>	
				<div style="text-align:center; padding-top:1.0em;">
							<input type="submit" name="botao_salvar" maxlength="11" value="Salvar" style="height:35px;border: 1px solid #7f9db9;border-radius:3px;">
				</div>	<br>
			</div>
		</form>	
	</div>
</div>
</body>
</html>