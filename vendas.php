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
		<input type="submit" onclick="location.href= 'sistema.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Gerenciamento de Vendas</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="vendas.php" method="POST" name="form_busca">
			<div style="text-align:left;padding-left:2.2em;position:relative;width:50%;float:left;">
				<input type="text" name="busca" value="Nome produto" maxlength="30" size="45" style="height:27px;color:gray;border: 1px solid #7f9db9;">
				<input type="submit" name="botao_busca" maxlength="11" value="Procurar" style="height:35px;border: 1px solid #7f9db9;border-radius:3px;">
			</div>
		</form>
		<div style="text-align: right;padding-right: 1.0em;">
				<input type="submit" onclick="location.href= 'vendas_efetuadas.php'" name="botao_adicionar" maxlength="13" value="Vendas Efetuadas" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;background-color: #dbdbdb">
			</div>

			<br><br>
			<div style="text-align: left;vertical-align:middle;font-size:0.75em;padding-top:0.7em;padding-bottom:0.7em;padding-left: 1.0em;">
				Para registrar uma venda é necessário digitar o CPF do cliente, selecionar os produtos desejados e finalizar.
			</div>
			<?php
			
				if ($busca == ''){
				$sql = "SELECT produto.nome_produto, produto.estoque_produto, produto.id_produto, produto.preco_produto
					FROM produto 
					WHERE produto.estoque_produto > 0 AND current_date < produto.validade_produto order by produto.id_produto asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
				else{
					$sql = "SELECT produto.nome_produto, produto.estoque_produto, produto.id_produto, produto.preco_produto
					FROM produto 
					WHERE produto.estoque_produto > 0 AND current_date < produto.validade_produto AND
					produto.nome_produto ilike '%". $busca ."%' order by produto.id_produto asc;";
					$res = pg_query($conexao, $sql);
					$qtd_linhas = pg_affected_rows($res);
				}
			?>
			<div class="tabela_dados">
			<form action="confirmar_venda.php" method="POST" name="form_salvar">
				<div style="text-align:left; font-weight: bold; padding-bottom:0.7em;padding-top: 0.9em;">
						CPF do cliente: 
						<input type="text" name="cpf" value="" maxlength="11" size="45" style="height:27px;color:gray;border: 1px solid #7f9db9;"><br><br>
				</div>

					<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
					<?php if ($qtd_linhas > 0){ ?>
								<tr style="height:60px; background-color: #CCC;font-weight: bold;">
									<td style="border: 1px solid #7f9db9;" width="15%">Selecionar</td>
									<td style="border: 1px solid #7f9db9;" width="15%">Qtde</td>
									<td style="border: 1px solid #7f9db9;" width="15%">Id</td>
									<td style="border: 1px solid #7f9db9;" width="25%">Nome</td>									
									<td style="border: 1px solid #7f9db9;" width="20%">Preço</td>
									<td style="border: 1px solid #7f9db9;" width="10%">Estoque</td>
								</tr>

					<?php		while($linha = pg_fetch_array($res)){ 
									
						?>		
									<tr style="height:50px;">
										<td style="border: 1px solid #7f9db9;">
											
												<input type="checkbox" name="produtos[]"  value="<?php echo $i." ".$linha['id_produto']; ?>"/>
											
										</td>
										<td style="border: 1px solid #7f9db9;">
											<input type="text" name="qtds[]" value="1" maxlength="3" size="3" style="height:27px;border: 1px solid #7f9db9;"/>
										</td>
										<td style="border: 1px solid #7f9db9;"><?php echo ($linha['id_produto']);?></td>
										<td style="border: 1px solid #7f9db9;"><?php echo ($linha['nome_produto']);?></td>
										<td style="border: 1px solid #7f9db9;"><?php echo 'R$ '.number_format(($linha['preco_produto']),2);?></td>
										<td style="border: 1px solid #7f9db9;"><?php echo ($linha['estoque_produto']);?></td>
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
				<input type="submit" name="botao_salvar" maxlength="11" value="Finalizar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;"><br><br>
			</div>
		</form>
		</div>
	</div>
</div>
</body>
</html>