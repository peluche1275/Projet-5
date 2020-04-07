<?php

namespace Entity;

use \Framework\Entity;

class Account extends Entity
{
    // PROPERTIES //

    protected $pseudo;

    // METHOD //

    // GETTERS //

    public function pseudo()
    {
        return $this->pseudo;
    }

    // SETTERS //

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }


}