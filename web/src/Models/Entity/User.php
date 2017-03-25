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

    public function __construct($attrs = null) {
        if ($attrs) {
            foreach ($attrs as $key => $attr) {
                $this->$key = $attr;
            }
        }
    }

    /**
     * Undocumented function
     * 
     * @return void
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * Undocumented function
     * 
     * @param [type] $user
     * @return void
     */
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function getPass() {
        return $this->pass;
    }

    public function setPass($pass) {
        $this->pass = md5($pass);
        return $this;
    }

    public function getToken() {
        return $this->token;
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    /**
     * Gera um Token - Melhorar depois
     * @return void
     */
    public function generateToken() {
        $token = microtime();
                $this->token = md5($token);
    }

    /**
     * Transforma o Password em MD5
     * @return void
     */
    public function generatePasswordHash() {
        $this->setPass(md5($this->getPass()));
    }

    /**
     * Getter dos atributos da entidade
     * @return void
     */
    public function getValues() {
        return get_object_vars($this);
    }

}