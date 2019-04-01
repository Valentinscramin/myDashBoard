<?php

class Session {

	function IniciarSessao($array) {

		if (!isset($_SESSION)) {

			ini_set("session.gc_maxlifetime", 86400);
			ini_set("session.cache_expire", 14400);
			session_save_path();

			session_start();

			if (!empty($array)) {

				foreach ($array as $name => $value) {
					if ($name != "senha") {
						$_SESSION["$name"] = "$value";
					}
					continue;
				}

				header("Location: index.php");

			} else {

				return "Usuario em branco";

			}

		}
	}
}
?>