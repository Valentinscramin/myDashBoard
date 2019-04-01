<?php

class CadastroPerfil extends Connection_Data_Base {

	function CadastroPerfil() {
		$this->setTableName("CadastroPerfil");
		$camposTabela = array("nome", "sobrenome", "email", "data_nascimento", "usuario", "senha");
		$this->setConlumns($camposTabela);
	}

}

?>
