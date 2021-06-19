<?php
session_start();
$conexao = pg_connect("host=testebancodado.postgresql.dbaas.com.br port=5432 dbname=testebancodado user=testebancodado password=bob12345!");
$busca = $_POST["busca"];
$cpf = $_POST["cpfs"];
$num = $_POST['id'];
$cont = $_POST["conts"];
$data = $_POST['datas'];
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
		<input type="submit" onclick="location.href= 'vendas_efetuadas.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Detalhamento Venda</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		 <div style="text-align:center;">
		 	<div style="text-align:right;padding-left:1.8em;padding-right:0.5em;position:relative;width:20%;float:left;color:#2a3d59;font-weight: bold;font-size:0.9em;">
		 		Data Compra:<br>
				Cliente:<br><br>
			</div>
			<div style="text-align: left;font-size:0.9em;">
		 		<?php echo date('d-m-Y', strtotime($data[$num]));?><br>
		 		<?php echo $cpf[$num];?><br><br>
		 	</div>
		 	<table align="center" width="65%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
		 		<tr style="height:60px; background-color: #CCC;font-weight: bold;font-size:0.9em;">
		 			<td style="border: 1px solid #7f9db9;" width="40%">Produto</td>
		 			<td style="border: 1px solid #7f9db9;" width="15%">Preço</td>
		 			<td style="border: 1px solid #7f9db9;" width="10%">Qtd</td>
		 		</tr>
		 			<?php 
						$sql ="select distinct id_produto from compra where cpf_cliente='". $cpf[$num] ."' AND data_compra='". $data[$num]."';";
						$res = pg_query($conexao, $sql);
						$qtd_linhas = pg_affected_rows($res);

						while($linha = pg_fetch_array($res)){ 

							$sql1 ="select id_produto, nome_produto, preco_produto from produto where id_produto='". $linha['id_produto'] ."';";
							$res1 = pg_query($conexao, $sql1);
							$consulta1 = pg_fetch_assoc($res1);

							$sql2 = "select count(*) as quant from compra where cpf_cliente='". $cpf[$num] ."' AND data_compra='". $data[$num]."' AND id_produto='". $linha['id_produto'] ."';";
							$res2 = pg_query($conexao, $sql2);
							$consulta2 = pg_fetch_assoc($res2);

							$total = $consulta1['preco_produto'] * $consulta2['quant'] + $total;
					?>
			 		<tr style="height:50px;font-size:0.9em;">
			 			<td style="border: 1px solid #7f9db9;"><?php echo $consulta1['nome_produto'];?></td>
			 			<td style="border: 1px solid #7f9db9;"><?php echo 'R$ '.number_format(($consulta1['preco_produto']),2);?></td>
			 			<td style="border: 1px solid #7f9db9;"><?php echo $consulta2['quant'];?></td>
			 		</tr>
		 			<?php } ?>
		 		<tr>
		 			<td colspan="3" style="border: 1px solid #7f9db9;color:#663333;font-weight: bold; font-size:0.9em;"> 
		 				<br>Valor total: R$ <?php echo number_format($total,2);?><br><br>
		 			</td>
		 		</tr>
			</table>
		 </div>
		 
		 <br>		 
	</div>
</div>
</body>
</html>