<?php
require_once("cabecalho.php");
if (!isset($_SESSION)) {
	session_start();
}
?>

	<div class="container">
		<div class="row">
			<div class="col-1"></div>
		<div class="col-4 mt-5">
			<h2>Suporte</h2>
			<br>
			<p>Olá, esta página é destinada ao seu suporte, visamos por meio dela receber suas críticas, opiniões, bugs e até mesmo receber suas dúvidas, para assim respondermos e facilitarmos o seu uso.</p>
		</div>

		<?php
		if (isset($_SESSION['usuario'])){		
		?>

		<div class="col-7 mt-5">
			<form action="../backend/cadastrarSuporte.php" method="post" class="mt-5">
				<div class="row">
					<div class="col-2"></div>
					<div class="col-6">
						<textarea id="textSuporte" class="rounded" name="textoSuporte" placeholder="Digite aqui"></textarea>
					</div>
				</div>
				<div class="row mt-5">
					<div class="col-2"></div>
					<div class="col-4 mt-3">
						<button type="submit" class="btn btn-primary">Enviar</button>
					</div>
				</div>	
			</form>
		</div>
	</div>
		<?php 
		error_reporting(0);
		ini_set(“display_errors”, 0 );
		if ($_SESSION['suporte_cadastrado']):  
		?>
		<div class="alert alert-primary mt-3 p-0" role="alert">
			<p class="text-center mt-3">Seu problema foi informado à nossa equipe!</p>
		</div>
		<?php 
		endif;
		unset($_SESSION['suporte_cadastrado']);

		
	}else{
		?>
	</div>
		<h2 class="text-danger text-center mt-5">Para informar um problema você deve estar logado!</h2>
		<div class="row justify-content-center mt-4">
			<a href="telaLogin.php"><button class="btn button-center" style="background-color: #a52a2a; color: white;">Logar-se</button></a>
		</div>
		<div class="row justify-content-center mt-1">
			<a href="cadastro.php"><button class="btn" >Cadastrar-se</button></a>
		</div>
		<?php }
		?>
	
	</div>

<?php
require_once("rodape.php");
?>