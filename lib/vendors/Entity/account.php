<?php

namespace Entity;

use \Framework\Entity;

class Account extends Entity
{
    // PROPERTIES //

    protected $pseudo;
    protected $id;
    protected $avatar;

    // CONSTRUCTOR //

    public function __construct(array $donnees = [])
    {
        if (!empty($donnees)) {
            $this->hydrate($donnees);
        }
    }

    // METHOD //

    // GETTERS //

    public function pseudo()
    {
        return $this->pseudo;
    }

    public function id()
    {
        return $this->id;
    }

    public function avatar()
    {
        return $this->avatar;
    }

    // SETTERS //

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


}