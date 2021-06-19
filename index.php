<?php
session_start();
$_SESSION['in']=0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Petolavo 1.0</title>
<link rel="stylesheet" type="text/css" href="estilos.css"/>
</head>

<body>

<div class="container">
<div class="petolavo" style="width:100%;">Petolavo 1.0	</div>
	<div class="box"><img src="images/cover.png" class="img_dog"></div>
		<br><br>
	<div class="box">
		<div class="box1">Acesso ao sistema</div>
		<div class="box2">
			<br><form action="login.php" method="POST" name="form_login">
			<table>
				<tr>
					<td>Usuário:</td>
					<td><input type="text" name="usuario" maxlength="4" size="25" class="campo_login"></td>
				</tr>
				<tr>
					<td>Senha:</td>
					<td><input type="password" name="senha" maxlength="11" size="25"  class="campo_login"></td>
				</tr>
				<tr>
					<td><br><div style="text-align:center;"><input type="submit" name="botao_login" maxlength="11" value="Entrar" class="botao_entrar"></div></td>
					<td><br><div style="text-align:center;"><a href="esqueci.php" style="">Esqueci minha senha</a></div></td>
				</tr>
				<?php
				if($_SESSION['in']==2){
				?>
				<tr>
					<td colspan="2"><br><div style="text-align:center;color: red;">Acesso incorreto!</div></td>
				</tr>
				<?php
					}
				?>
			</table>
			</form>
		</div>
	</div>
</div>
</body>
</html>