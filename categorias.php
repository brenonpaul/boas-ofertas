<?php
require_once "cabecalho.php";
require_once "class/conexao.php";
?>

<div class="container mt-4">
	<div class="row d-flex justify-content-center">	
		<?php
		$result_produto = "SELECT * FROM categorias ORDER BY nome_categoria ASC";
		$resultado_produto = mysqli_query($conexao, $result_produto);
		while($row_produto = mysqli_fetch_assoc($resultado_produto)){
			
			echo ("<div class='col-xl-2 col-lg-3 col-md-4 col-sm-4 col-6 recentes mt-4 rounded border border-secondary'>
				<div class='row'>");
				?>
				<a href="index.php?cat=<?php echo $row_produto['id_categoria']?>">
					<img src="imagens/categorias/<?php echo $row_produto['foto_categoria']?>" class='imgProd rounded border-secondary'>
					<?php
					echo ("</div>
						<div class='row d-flex justify-content-center'>");
						?>
						
						<h6 class="text-body"><strong><?php echo ($row_produto['nome_categoria']); ?></strong></h6></a>
						
						<?php	
						echo("</div>
							");							
						echo("</div>
							<div class='col-1'></div>");
					}
					?>
				</div>
			</div>	

			<?php
			require_once "rodape.php";
			?>