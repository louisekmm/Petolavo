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
		<input type="submit" onclick="location.href= 'cirurgias.php'" name="botao_back" maxlength="13" value="<<  Voltar" class="botao_voltar">
	</div>
	<div style="text-align: right;padding-right: 1.1em; padding-bottom:0.2em;">
		<input type="submit" onclick="location.href= 'logout.php'" name="botao_logout" maxlength="13" value="Sair" class="botao_sair">
	</div>

	<hr>
	<br>
	<div class="box6">Gerenciamento de Cirurgias</div>
	<div style="text-align: right;padding-right: 0.2em; padding-bottom:0.5em;">Data: <?php echo date('d/m/Y'); ?></div>
	
	<div class="tabela_sis">
		
		<form action="salvar_cirurgias.php" method="POST" name="form_salvar">
			
			<?php
				$sql = "SELECT cirurgia.desc_cirurgia, cirurgia.data_cirurgia, cirurgia.id_historico
					FROM cirurgia WHERE cirurgia.id_cirurgia=". $id .";";
				$res = pg_query($conexao, $sql);
				$qtd_linhas = pg_affected_rows($res);
				
				$sql1 = "SELECT animal.nome_animal FROM animal WHERE animal.id_animal=". $animal ." ;";
				$res1 = pg_query($conexao, $sql1);
				$consulta1 = pg_fetch_assoc($res1);

			?>
			<div class="tabela_dados">
				<?php if ($qtd_linhas > 0){ ?>
					<table align="center" width="100%" style="border: 1px solid #7f9db9;border-collapse: collapse;">
						<?php while($linha = pg_fetch_array($res)){ ?>
						<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Animal</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<?php echo ($consulta1['nome_animal']);?>
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Data</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<?php echo  date('d-m-Y', strtotime($linha['data_cirurgia']));?>
									<input type="hidden" name="data" value="<?php echo($linha['data_cirurgia']);?>">
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid #7f9db9;height:45px;font-weight: bold;" width="40%">Descrição</td>
								<td style="border: 1px solid #7f9db9;" width="50%">
									<?php if (($linha['desc_cirurgia']) == 'Agendada'){ ?> 
										<textarea rows="5" name="desc" cols="30" maxlength="100"></textarea> 
									<?php }else{?>
										<textarea rows="5" cols="30" name="desc" maxlength="100"><?php echo ($linha['desc_cirurgia']);?></textarea> 
									<?php }?>
								</td>
							</tr>
							<?php }?>
					</table>	
				<?php }?>
				<div style="text-align:center; padding-top:1.0em;">
							<input type="submit" name="botao_salvar" maxlength="11" value="Salvar" style="font-weight: bold;height:35px;border: 1px solid #7f9db9;border-radius:3px;">
							<input type="hidden" name="id" value="<?php echo $id;?>">
				</div>				
			</div>
		</form>	
	</div>
</div>
</body>
</html>