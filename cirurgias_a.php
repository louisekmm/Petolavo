<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
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
	<div class="box6">Gerenciamento de Cirurgias</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="cirurgias_a.php" method="POST" name="form_busca">
			<div style="text-align:left;padding-left:2.2em;position:relative;width:50%;float:left;">
				<input type="text" name="busca" value="Nome do cliente" maxlength="30" size="45" style="height:27px;color:gray;border: 1px solid #7f9db9;">
				<input type="submit" name="botao_busca" maxlength="11" value="Procurar" style="height:35px;border: 1px solid #7f9db9;border-radius:3px;">
			</div>
		</form>
				<div style="text-align: right;padding-right: 1.0em;">
				<input type="submit" onclick="location.href= 'adicionar_cirurgias_a.php'" name="botao_adicionar" maxlength="13" value="Marcar Cirurgia" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;background-color: #dbdbdb">
			</div>		
			<br><br>

			<?php
			
				if ($busca == ''){
				$sql = "SELECT animal.nome_animal,cirurgia.preco_cirurgia, animal.id_animal, cliente.nome_cliente, cirurgia.id_cirurgia, cirurgia.desc_cirurgia, cirurgia.data_cirurgia
					FROM cliente
					INNER JOIN animal ON animal.cpf_cliente=cliente.cpf_cliente
					INNER JOIN historico_medico ON historico_medico.id_animal = animal.id_animal
					INNER JOIN cirurgia ON cirurgia.id_historico = historico_medico.id_historico WHERE cirurgia.data_cirurgia >= current_date order by animal.nome_animal asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
				else{
					$sql = "SELECT animal.nome_animal, cirurgia.preco_cirurgia, animal.id_animal, cliente.nome_cliente, cirurgia.id_cirurgia, cirurgia.desc_cirurgia, cirurgia.data_cirurgia
					FROM cliente
					INNER JOIN animal ON animal.cpf_cliente=cliente.cpf_cliente
					INNER JOIN historico_medico ON historico_medico.id_animal = animal.id_animal
					INNER JOIN cirurgia ON cirurgia.id_historico = historico_medico.id_historico
					WHERE cliente.nome_cliente ilike '%". $busca ."%' AND cirurgia.data_cirurgia >= current_date order by animal.nome_animal asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
			?>
			<div class="tabela_dados">
				<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
				<?php if ($qtd_linhas > 0){ ?>
							<tr style="height:60px; background-color: #CCC;font-weight: bold;">
								<td style="border: 1px solid #7f9db9;" width="10%">Editar</td>
								<td style="border: 1px solid #7f9db9;" width="22,5%">Animal</td>
								<td style="border: 1px solid #7f9db9;" width="30%">Cliente</td>
								<td style="border: 1px solid #7f9db9;" width="20%">Data Cirurgia</td>
								<td style="border: 1px solid #7f9db9;" width="20%">Preço</td>
							</tr>

				<?php		while($linha = pg_fetch_array($res)){ ?>		
								<tr style="height:50px;">
									<td style="border: 1px solid #7f9db9;">
										<a href="incluir_cirurgia_a.php?a=<?php echo $linha['id_animal']; ?>&i=<?php echo $linha['id_cirurgia']; ?>">
											<img src="images/icone_edit.png" height="33" width="33">
										</a>
									</td>
									<td style="border: 1px solid #7f9db9;"><?php echo ($linha['nome_animal']);?></td>
									<td style="border: 1px solid #7f9db9;"><?php echo ($linha['nome_cliente']);?></td>
									<td style="border: 1px solid #7f9db9;"><?php echo date('d-m-Y', strtotime($linha['data_cirurgia']));?></td>
									<td style="border: 1px solid #7f9db9;"><?php echo 'R$ '.number_format(($linha['preco_cirurgia']),2);?></td>
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