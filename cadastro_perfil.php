<?php
include "classes/Connection_Data_Base.class.php";
include "classes/CadastroPerfil.class.php";

include "header.php";

$obj_cadastroPerfil = new CadastroPerfil();
$editar = "";
$listando = "";
$id = isset($_POST["id"]) ? $_POST["id"] : "";

if (isset($_POST["acao"])) {

	if ($_POST["acao"] == "salvar") {

		$registro = array();

		if ($id != NULL) {

			$registro["id"] = $id;

		}

		$registro["nome"] = $_POST["nome"];
		$registro["sobrenome"] = $_POST["sobrenome"];
		$registro["email"] = $_POST["email"];
		$registro["data_nascimento"] = $_POST["data_nascimento"];
		$registro["usuario"] = $_POST["usuario"];
		$registro["senha"] = $_POST["senha"];

		if ($_POST["id"] != NULL) {

			$obj_cadastroPerfil->updateRecord($registro);

		} else {

			$id_inserido = $obj_cadastroPerfil->insertRecord($registro);

		}

		//echo file_get_contents('localhost/myApplication/cadastro_perfil.php', null, $id_inserido);

		header("Location: cadastro_perfil.php");

	}

	if ($_POST["acao"] == "excluir") {

		$obj_cadastroPerfil->deleteRecord($id);

		header("Location: cadastro_perfil.php");
	}

	if ($_POST["acao"] == "editar") {

		$editar = true;

	}

	if ($_POST["acao"] == "listando") {

		$listando = true;

	}

} else {

	$listando = true;

}

?>

<div class="container">

		<h1 class='text-center letters_effect_1'>Cadastro de Usuario</h1>
		</br>
		<center>
			<form name="navegacao" id="navegacao" method="POST">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
		  	</form>

		<?php if ($editar) {?>

			<button class="btn btn-success btn-md salvar button_effect_2">Salvar</button>
			<button class="btn btn-danger  btn-md excluir button_effect_2">Excluir</button>
			<button class="btn btn-warning btn-md cancelar button_effect_2">Cancelar</button>
			</br>

		<?php }if ($listando) {
	?>

			<button class="btn btn-primary btn-md novo button_effect_2">Novo</button>
			</br>
		</center>

		<hr class="my-4">


			<table class="table">
		  <thead>
		    <tr>
		      <th scope="col">ID</th>
		      <th scope="col">Usuario</th>
		      <th scope="col">Nome</th>
		      <th scope="col">Sobrenome</th>
		      <th scope="col">Senha</th>
		    </tr>
		  </thead>
		  <tbody>


		  	<form name="editar" id="editar" method="POST">
		  	<input type="hidden" name="acao" value="editar">
		  	</form>

		<?php

	$todos = $obj_cadastroPerfil->getTodos();

	if (is_array($todos)) {

		foreach ($todos as $cadaUm) {

			echo '
		    <tr class="btn-edit" data-id="' . $cadaUm['id'] . '">
		      <th>' . $cadaUm['id'] . '</th>
		      <td>' . $cadaUm['usuario'] . '</td>
		      <td>' . $cadaUm['nome'] . '</td>
		      <td>' . $cadaUm['sobrenome'] . '</td>
		      <td>' . $cadaUm['senha'] . '</td>
		    </tr>';

		}

	}
	?>

		  </tbody>
		</table>

		<?php }?>

		<?php if ($editar) {

	$id_registro = isset($_POST["id"]) ? $_POST["id"] : NULL;

	$registro = $obj_cadastroPerfil->getByID($id_registro);

	@$usuario = $registro["usuario"];
	@$senha = $registro["senha"];
	@$nome = $registro["nome"];
	@$sobrenome = $registro["sobrenome"];
	@$email = $registro["email"];
	@$data_nascimento = $registro["data_nascimento"];

	$link_image = "";

	?>

			<div class="container img_perfil">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<div class="imagem_perfil">
							<center>
								<img width="130px" height="200px" class="img-circle" src="<?php echo $link_image; ?>" alt="Sem foto de perfil">
							</center>
						</div>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>

			 </br>
			  <p class="text-center">Preencha os dados abaixo para realizar o cadastro.</p>

			<center>
			 <form id="salvar" name="salvar" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="acao" value="salvar">
				<input type="hidden" name="id"   value="<?php echo $id_registro; ?>">

				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" style="min-width: 140px;">@</span>
				  <input type="text" class="form-control" name = "usuario" placeholder="usuario" value="<?php echo $usuario; ?>">
				</div>
				</br>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" style="min-width: 140px;">Senha</span>
				  <input type="password" class="form-control" name = "senha" placeholder="Senha" value="<?php echo $senha; ?>">
				</div>
				</br>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" style="min-width: 140px;">Nome</span>
				  <input type="text" class="form-control" name = "nome" placeholder="Nome" value="<?php echo $nome; ?>">
				</div>
				</br>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" style="min-width: 140px;">Sobrenome</span>
				  <input type="text" class="form-control" name = "sobrenome" placeholder="Sobrenome" value="<?php echo $sobrenome; ?>">
				</div>
				</br>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" style="min-width: 140px;">E-mail</span>
				  <input type="text" class="form-control" name = "email" placeholder="E-mail" value="<?php echo $email; ?>">
				</div>
				</br>
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1" style="min-width: 140px;">Data Nascimento</span>
				  <input type="date" class="form-control" name = "data_nascimento" value="<?php echo $data_nascimento; ?>">
				</div>
				</br>
				<buton class="btn btn-primary btn_perfil disabled">Escolher Foto</buton>
				</br>
			</form>
			</center>


		<?php }?>



</div>


<?php

include_once "footer.php";
?>


