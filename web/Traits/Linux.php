<?php

namespace App\Traits;

/**
* Conjunto de funções para serem utilizadas junto ao Linux
*/
trait Linux 
{
    
    /**
    * Executa um comando Linux
    * @author Matheus Fidelis <matheus.scarpato@superlogica.com>
    * @param  [type] $command [description]
    * @return [type]          [description]
    */
    public function execute($command) 
    {
        if (is_null($command)) {
            throw new Exception("Invalid Command", 500);
        } else {
            return shell_exec($command);
        }
    }
    
    public function remove($path) 
    {
        if (!is_file($path)) {
            throw new Exception("File not found", 500);
        } else {
            @unlink($path);
        }
    }
}