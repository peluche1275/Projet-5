<?php

namespace App\Frontend\Modules\Connection;

use \Framework\BackController;
use \Framework\HTTPRequest;

class ConnectionController extends BackController
{

    // METHODS //

    public function executeIndex()
    {
        $this->page->addVar('title', 'Accueil du jeu');
    }

    public function executeInscription(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Inscription');

        $manager = $this->managers->getManagerOf('Connection'); 
        
        if ($request->postExists('pseudo'))
        {
        $pseudo = $request->postData('pseudo');
        $password = password_hash($request->postData('password'),PASSWORD_DEFAULT);
        $email = $request->postData('email');

        $manager->inscription($pseudo,$password,$email);
        }
    }

    public function executeConnexion(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Inscription');

        $manager = $this->managers->getManagerOf('Connection'); 
        
        if ($request->postExists('pseudo'))
        {
        $pseudo = $request->postData('pseudo');
        $password = $request->postData('password');

        $manager->connexion($pseudo,$password);
        }
    }
}
