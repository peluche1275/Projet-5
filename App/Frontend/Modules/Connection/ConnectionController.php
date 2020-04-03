<?php

namespace App\Frontend\Modules\Connection;

use \Framework\BackController;

class ConnectionController extends BackController
{

    // METHODS //

    public function executeIndex()
    {
        $this->page->addVar('title', 'Accueil du jeu');
    }
}
