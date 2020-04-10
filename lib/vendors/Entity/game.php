<?php

namespace Entity;

use \Framework\Entity;

class Game extends Entity
{
    // PROPERTIES //

    protected $otages;
    protected $soldats;
    protected $argents;
    protected $progression;

    // GETTERS //

    public function otages()
    {
        return $this->otages;
    }

    public function soldats()
    {
        return $this->soldats;
    }

    public function argents()
    {
        return $this->argents;
    }

    public function progression()
    {
        return $this->progression;
    }
    
    // SETTERS //

    public function setOtages($otages)
    {
        $this->otages = $otages;
    }

    public function setSoldats($soldats)
    {
        $this->soldats = $soldats;
    }

    public function setArgents($argents)
    {
        $this->argents = $argents;
    }

    public function setProgression($progression)
    {
        $this->progression = $progression;
    }


}