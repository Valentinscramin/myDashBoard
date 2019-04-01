<?php

class Connection_Data_Base {

	///////////DADOS DO BANCO///////////////

	public $local = "localhost";
	public $user = "root";
	public $password = "";
	public $bd = "phpFramework";

	///////////////////////////////////////

	private $tableName = "";
	public $columns = "";

	public function setTableName($tableName) {
		$this->tableName = $tableName;
	}

	public function setConlumns($columns) {

		if (is_array($columns)) {
			$this->columns = $columns;
		}

	}

	////////////////////////////////////////////////////////////////////
	function conexao($sql) {

		@$conn = new mysqli($this->local, $this->user, $this->password, $this->bd);

		if ($sql) {
			$result = mysqli_query($conn, $sql);
		}

		return $result;

		mysqli_close($conn);

	}
	////////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////
	function todasTabelas() {

		$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_TYPE='$this->bd'";
		return $this->conexao($sql);
	}
	///////////////////////////////////////////////////////////////////

	////////////////////////////////////////////////////////////////////
	//INSERIR NO BANCO DE DADOS
	function insertRecord($array) {

		$columns = implode(", ", ($this->columns));

		$tamanhoArray = count($array);
		$contador = 0;
		$dados = "";

		foreach ($array as $cadaUm => $value) {

			$contador++;

			if ($contador < $tamanhoArray) {

				$dados = $dados . "'" . $value . "'" . ", ";

			} else {

				$dados = $dados . "'" . $value . "'";

			}

		}

		$sql = "INSERT INTO $this->tableName($columns)VALUES($dados)";

		$this->conexao($sql);

		$sql = "SELECT MAX(id) FROM $this->tableName";

		$id_inserido = $this->conexao($sql);

		$return = array();

		while ($row_user = mysqli_fetch_assoc($id_inserido)) {
			$return[] = $row_user;
		}

		foreach ($return as $cadaUm) {
			return $cadaUm["id"];
		}

	}

	////////////////////////////////////////////////////////////////////
	//UPDATE NO BANCO DE DADOS

	function updateRecord($array) {

		$columns = implode(", ", ($this->columns));

		$tamanhoArray = count($array);
		$contador = 0;
		$dados = "";

		$id_registro = reset($array);

		foreach ($array as $cadaUm => $value) {

			$contador++;

			if ($contador == 1) {

				continue;

			} else {

				foreach ($this->columns as $cadaColuna) {
					if ($cadaUm == $cadaColuna) {

						if ($contador != $tamanhoArray) {
							$dados = $dados . $cadaColuna . ' = ' . '"' . $value . '", ';
						} else {
							$dados = $dados . $cadaColuna . ' = ' . '"' . $value . '"';
						}
					}
				}

			}
		}

		$sql = "UPDATE $this->tableName SET $dados WHERE (id) = ('$id_registro')";

		$this->conexao($sql);

	}
	////////////////////////////////////////////////////////////////
	//DELETAR NO BANCO DE DADOS
	function deleteRecord($id) {

		$sql = "DELETE FROM $this->tableName WHERE (id) = ('$id')";

		$this->conexao($sql);
	}
	////////////////////////////////////////////////////////////////
	//SELECIONAR TODOS DO BANCO DE DADOS
	//
	function getTodos() {

		$sql = "SELECT * FROM $this->tableName";

		$result = $this->conexao($sql);

		$return = array();

		while ($row_user = mysqli_fetch_assoc($result)) {
			$return[] = $row_user;
		}

		return $return;

	}

	////////////////////////////////////////////////////////////////
	//SELECIONAR PELO ID DO BANCO DE DADOS
	function getByID($id) {

		if ($id) {

			$sql = "SELECT * FROM $this->tableName WHERE (id) = ('$id')";

			$result = $this->conexao($sql);

			$return = array();

			while ($row_user = mysqli_fetch_assoc($result)) {
				$return[] = $row_user;
			}

			foreach ($return as $cadaUm) {
				return $cadaUm;
			}

		} else {

			return null;

		}

	}
	////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////
	//MONTA UM COMBO DE OPTION PARA POR NO SELECT, CASO JA AJA ALGUM SELECIONADO PASSAR POR PARAMETRO
	function getCombo($todos, $id_selecionado) {
		foreach ($todos as $cadaUm) {

			if ($id_selecionado == $cadaUm["id"]) {
				$selected = "selected";
			} else {
				$selected = "";
			}

			echo "<option value=" . $cadaUm['id'] . " " . $selected . ">" . $cadaUm['nome'] . "</option>";
		}
	}
	//MONTA UM COMBO DE OPTION PARA POR NO SELECT, CASO JA AJA ALGUM SELECIONADO PASSAR POR PARAMETRO
	///////////////////////////////////////////////////////////////

	//////////////////VERIFICAR USUARIO ///////////////////////////
	function consultarLogin($usuario, $senha) {

		if ($usuario AND $senha) {

			$sql = "SELECT * FROM $this->tableName WHERE (usuario) = ('$usuario')";

			$result = $this->conexao($sql);

			$return = array();

			while ($row_user = mysqli_fetch_assoc($result)) {
				$return[] = $row_user;
			}

			if ($return != NULL) {
				foreach ($return as $cadaUm) {

					if ($cadaUm["senha"] == $senha) {
						$senhaOK = TRUE;
					} else {
						$senhaOK = FALSE;
					}

					if ($senhaOK) {
						return $cadaUm;
					} else {
						return "senha_incorreta";
					}

				}
			} else {
				return "usuario_incorreto";
			}

		}
	}
	//////////////////VERIFICAR USUARIO ///////////////////////////

}

?>