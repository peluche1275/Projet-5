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

        if ($request->postExists('pseudo')) {
            $pseudo = $request->postData('pseudo');
            $password = password_hash($request->postData('password'), PASSWORD_DEFAULT);
            $email = $request->postData('email');

            $manager->inscription($pseudo, $password, $email);
        }
    }

    public function executeConnexion(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Inscription');

        $manager = $this->managers->getManagerOf('Connection');

        if ($request->postExists('pseudo')) {
            $pseudo = $request->postData('pseudo');
            $password = $request->postData('password');

            if ($manager->connexion($pseudo, $password)) {
                $this->app->user()->setAuthenticated(true);
                $this->app->httpResponse()->redirect('.');
            } else {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }

    public function executeDeconnexion()
    {
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('.');
    }
}
