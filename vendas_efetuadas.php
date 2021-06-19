<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
 $busca = $_POST["busca"];
 $i = 0;

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
		<input type="submit" onclick="location.href= 'vendas.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Histórico de Vendas</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="vendas_efetuadas.php" method="POST" name="form_busca">
			<div style="text-align:left;padding-left:2.2em;position:relative;width:50%;float:left;">
				<input type="text" name="busca" value="CPF Cliente" maxlength="30" size="45" style="height:27px;color:gray;border: 1px solid #7f9db9;">
				<input type="submit" name="botao_busca" maxlength="11" value="Procurar" style="height:35px;border: 1px solid #7f9db9;border-radius:3px;">
			</div>
		</form>

			<br><br>
			<div style="text-align: left;vertical-align:middle;font-size:0.75em;padding-top:0.7em;padding-bottom:0.7em;padding-left: 1.0em;">
				Para obter mais detalhes de uma venda selecione-a abaixo e clique em 'Detalhar'.
			</div>
			<?php
			
				if ($busca == ''){
				$sql = "select cpf_cliente, data_compra, count(*) as cont from compra group by cpf_cliente, data_compra
				 order by data_compra asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
				else{
					$sql = "select cpf_cliente, data_compra, count(*) as cont from compra where
					 cpf_cliente='". $busca ."' 
					 group by cpf_cliente, data_compra order by data_compra asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
			?>
			<div class="tabela_dados">
			<form action="vendas_edetalhe.php" method="POST" name="form_salvar">

					<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
					<?php if ($qtd_linhas > 0){ ?>
								<tr style="height:60px; background-color: #CCC;font-weight: bold;">
									<td style="border: 1px solid #7f9db9;" width="30%">Selecionar</td>
									<td style="border: 1px solid #7f9db9;" width="40%">CPF do Cliente</td>
									<td style="border: 1px solid #7f9db9;" width="30%">Data da Compra</td>	
								</tr>

					<?php		while($linha = pg_fetch_array($res)){ 
									
						?>		
									<tr style="height:50px;">
										<td style="border: 1px solid #7f9db9;">
											<input type="radio" name="id"  value="<?php echo $i; ?>"/>
											
										</td>
										<td style="border: 1px solid #7f9db9;">
											<?php echo ($linha['cpf_cliente']);?>
											<input type="hidden" name="cpfs[]" maxlength="3" size="3" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['cpf_cliente']);?>"/>
										</td>
										<td style="border: 1px solid #7f9db9;">
											<?php echo date('d-m-Y', strtotime($linha['data_compra']));?>
											<input type="hidden" name="datas[]" maxlength="3" size="3" style="height:27px;border: 1px solid #7f9db9;" value="<?php echo ($linha['data_compra']);?>"/>
										</td>
									</tr>
								<?php $i=$i+1;
							}
						} 
					    elseif ($qtd_linhas == 0){ ?>
						<tr>
							<td style="color: red;">Não há resultados.</td>
						</tr>
					<?php } ?>
			</table>
			<div style="text-align:center; padding-top:1.0em;">
				<input type="submit" name="botao_salvar" maxlength="11" value="Detalhar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;"><br><br>
			</div>
		</form>
		</div>
	</div>
</div>
</body>
</html>