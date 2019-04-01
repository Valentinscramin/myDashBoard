<?php
include "classes/Connection_Data_Base.class.php";
include "classes/cadastroPerfil.class.php";

include_once "header.php";

$nome = $_SESSION["nome"];
$sobrenome = $_SESSION["sobrenome"];
$email = $_SESSION["email"];
$data_nascimento = $_SESSION["data_nascimento"];
$usuario = $_SESSION["usuario"];

?>

	<div class="container">
		<div class="d-flex flex-row justify-content-around">
			<div class="card" style="width: 18rem;">
				<img src="" alt="">
			  <div class="card-body">
			    <h5 class="card-title">USUARIO: <?php echo $usuario; ?></h5>
			    <p class="card-text">Nome: <?php echo $nome . " " . $sobrenome; ?></p>
			    <p class="card-text">E-Mail: <?php echo $email; ?></p>
			    <p class="card-text">Data Nascimento: <?php echo $data_nascimento; ?></p>
			    <center><a href="logout.php" class="btn btn-danger">Sair</a></center>
			  </div>
			</div>
		</div>
	</div>

<?php
include_once "footer.php";
?>


