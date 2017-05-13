<?php

namespace App\Models\Entity;

use App\Interfaces\Entity;

class Token implements Entity {

    /**
     * Getter dos atributos da entidade
     * @return void
     */
    public function getValues() {
        return get_object_vars($this);
    }

}