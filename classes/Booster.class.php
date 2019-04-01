<?php

class Booster {

	function insertPhoto($path, $orginalFile) {

		///INSERE QUALQUER ARQUIVO
		///NOME DADO HASH MD5 COM NOME DE ARQUIVO
		///DATA E HORA ATUAL

		$target_dir = $path;

		$arquivo = $orginalFile;

		$imageFileType = strtolower(pathinfo($arquivo, PATHINFO_EXTENSION));

		$nome = md5($arquivo . date("d-m-Y h:i")) . "." . $imageFileType;

		$target_file = $target_dir . basename($nome);

		// Check if image file is a actual image or fake image

		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

		if ($check !== false) {

			echo "COMPLETE INSET FILE";
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);

		} else {

			echo "ERROR IN INSERT FILE: function insertPhoto";

		}
	}

}

?>