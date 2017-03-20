<?php

namespace App\Models\Entity;

use App\Interfaces\Entity;

/**
 * Undocumented class
 */
class User implements Entity {

    /**
     * Nome do usuário
     * @var [type]
     */
    private $user;

    /**
     * Password do usuário
     * @var [type]
     */
    private $pass;

    /**
     * Token de validação do usuário
     * @var [type]
     */
    private $token;

    /**
     * Undocumented function
     * 
     * @return void
     */
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = $pass;
        return $this;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {

    }



    /**
     * Getter dos atributos da entidade
     * @return void
     */
    public function getValues() {
        return get_object_vars($this);
    }

}