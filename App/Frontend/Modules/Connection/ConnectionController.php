<?php

namespace App\Frontend\Modules\Connection;

use \Framework\BackController;
use \Framework\HTTPRequest;
use \Entity\Account;

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
            if ($request->postData('password') == $request->postData('password2')) 
            {
                $pseudo = $request->postData('pseudo');
                $password = password_hash($request->postData('password'), PASSWORD_DEFAULT);
                $email = $request->postData('email');
                $this->app->user()->setFlash('Inscription réalisée avec succès!');

                $manager->inscription($pseudo, $password, $email);
            } 
            else 
            {
                $this->app->user()->setFlash('Les deux mots de passe ne correspondent pas');
            }
            $this->app->httpResponse()->redirect('.');
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
                $this->app->user()->setAuthenticated(true, $pseudo);
                $this->app->httpResponse()->redirect('.');
            } else {
                $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
            }
        }
    }

    public function executeMonCompte()
    {
        $this->page->addVar('title', 'Mon compte');
        $account = new Account(['pseudo' => $_SESSION['nameAccount']]);
        $this->page->addVar('account', $account);
    }

    public function executeDeconnexion()
    {
        $this->app->user()->setAuthenticated(false, "noaccount");
        $this->app->httpResponse()->redirect('.');
    }
}
