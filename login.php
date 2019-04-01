<?php
include "classes/Connection_Data_Base.class.php";
include "classes/CadastroPerfil.class.php";
include "classes/Session.class.php";

$obj_session = new Session();
$obj_cadastroPerfil = new CadastroPerfil();

@$usuario = ($_POST["usuario"]) ? $_POST["usuario"] : "";
@$senha = ($_POST["senha"]) ? $_POST["senha"] : "";

if (isset($_POST["acao"])) {
	if ($_POST["acao"] == "consultar") {

		$registro = $obj_cadastroPerfil->consultarLogin(@$usuario, @$senha);

		if ($registro != "senha_incorreta" AND $registro != "usuario_incorreto") {
			$return = $obj_session->IniciarSessao($registro);
		} else {
			if ($registro == "senha_incorreta") {
				$senhaEnableMessage = TRUE;
				$usuarioEnableMessage = FALSE;
			} elseif ($registro == "usuario_incorreto") {
				$usuarioEnableMessage = TRUE;
				$senhaEnableMessage = FALSE;
			}
		}
	}
}

include "header.php";
?>

    <div class="row">
         <div class="col-md-4">
         </div>
        <div class="col-md-4">
        	<div class="jumbotron">
               <form class="form" method="POST">
               <input type="hidden" name="acao" value="consultar">
               	<center>
                   <div class="form-group">
                       <input type="text" style="min-width: 100px;" name="usuario" class="form-control" placeholder="Usuario"
                        value="<?php echo @$usuario; ?>" required="required">
                   </div>
                   <div class="form-group">
                        <input type="password" style="min-width: 100px;" name="senha" class="form-control" placeholder="Senha"
                        value="<?php echo @$senha; ?>" required="required">
                   </div>
                   <?php
if (@$senhaEnableMessage) {
	echo '<div class="alert alert-warning" role="alert">
                                                  Senha incorreta!
                                                </div>';
}
if (@$usuarioEnableMessage) {
	echo '<div class="alert alert-warning" role="alert">
                                                  Usuario não encontrado!
                                                </div>';
}
?>
                   <br>
                   <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-success btn-md" value="Login">
                   </div>
                   </center>
               </form>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>

<?php
include "footer.php";
?>