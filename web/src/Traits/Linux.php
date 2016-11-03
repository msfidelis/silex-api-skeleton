<?php 

namespace App\Traits;

trait Linux {

	public function execute($command) {
		if (is_null($command)) {
			throw new Exception("Comando inválido", 1);
		} else {
			return shell_exec($command);
		}
	}

	public function remove($path) {
		if (!is_file($path)) {
			throw new Exception("Arquivo não encontrado", 1);
		} else {
			@unlink($path);
		}
	}
}