<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
$busca = $_POST["busca"];
$cpf = $_POST["cpf"];
$qtd = $_POST['qtds'];
$total = 0;


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
	<div class="box6">Confirmar Venda</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		<div><?php echo $_SESSION['nome'];?>, você realmente deseja registrar a compra abaixo?</div><br>
		 <form action="salvar_vendas.php" method="POST" name="form_salvar">
		 <div style="text-align:center;">
		 <input type="hidden" name="cpff" value="<?php echo $cpf;?>">
		 	<table align="center" width="65%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
		 		<tr style="height:60px; background-color: #CCC;font-weight: bold;font-size:0.9em;">
		 			<td style="border: 1px solid #7f9db9;" width="40%">Produto</td>
		 			<td style="border: 1px solid #7f9db9;" width="15%">Preço</td>
		 			<td style="border: 1px solid #7f9db9;" width="10%">Qtd</td>
		 		</tr>
		 			<?php 
						foreach($_POST['produtos'] as $prod){
							$test = (explode (" ", $prod));
							$pos = $test[0];
							
							$id_produto = $test[1];
							
							$quantidade = $qtd[$pos];
							

							$sql = "SELECT produto.nome_produto, produto.preco_produto
										FROM produto 
										WHERE produto.id_produto = ". $id_produto .";";
										$res = pg_query($conexao, $sql);
										$qtd_linhas = pg_affected_rows($res);
							while($linha = pg_fetch_array($res)){ 
								$total = $linha['preco_produto'] * $quantidade + $total;
					?>
		 		<tr style="height:50px;font-size:0.9em;">
		 			<td style="border: 1px solid #7f9db9;">
		 				<?php echo ($linha['nome_produto']);?>
		 				<input type="hidden" name="ids[]" value="<?php echo $id_produto;?>"/>
		 			</td>
		 			<td style="border: 1px solid #7f9db9;"><?php echo 'R$ '.number_format(($linha['preco_produto']),2);?></td>
		 			<td style="border: 1px solid #7f9db9;">
		 				<?php echo ($quantidade);?>
		 				<input type="hidden" name="qtdes[]" value="<?php echo $quantidade;?>"/>
		 			</td>
		 		</tr>
		 			<?php }
		 			}
		 			?>
		 		<tr>
		 			<td colspan="3" style="border: 1px solid #7f9db9;color:#2a3d59;font-weight: bold;">
		 				 <br>Valor total: R$ <?php echo number_format($total,2);?><br><br>
		 			</td>
		 		</tr>
			</table>
		 </div>
		 
		 <br>		 
		<div style="padding-left: 15.0em;font-size:0.9em;position:relative;width:20%;float:left;text-align:left;">
			<input type="submit" name="botao_salvar" maxlength="11" value="Confirmar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;">
		</div>
		</form>
				<div style="text-align: right;padding-right: 13.0em;">
			<input type="submit" name="botao_cancelar" maxlength="11" onclick="location.href= 'vendas.php'" value="Cancelar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;">
		</div>
	</div>
</div>
</body>
</html>