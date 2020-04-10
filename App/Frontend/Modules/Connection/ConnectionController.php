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
        if ($this->app->user()->isAuthenticated()) {
            $manager = $this->managers->getManagerOf('Connection');
            $account = new Account($manager->account($_SESSION['nameAccount']));
            $this->page->addVar('account', $account);
        }
    }

    public function executeInscription(HTTPRequest $request)
    {
        $this->page->addVar('title', 'Inscription');

        $manager = $this->managers->getManagerOf('Connection');

        if ($request->postExists('pseudo')) {
            if ($request->postData('password') == $request->postData('password2')) {
                $pseudo = $request->postData('pseudo');
                $password = password_hash($request->postData('password'), PASSWORD_DEFAULT);
                $email = $request->postData('email');

                if ($manager->verification($pseudo)) {
                    $this->app->user()->setFlash('Ce pseudo existe déjà!');
                    $this->app->httpResponse()->redirect('/inscription');
                } else {
                    $this->app->user()->setFlash('Inscription réalisée avec succès!');
                    $manager->inscription($pseudo, $password, $email);
                    $this->app->httpResponse()->redirect('/login');
                }
            } else {
                $this->app->user()->setFlash('Les deux mots de passe ne correspondent pas');
            }
        }
    }

    public function executeContact(HTTPRequest $request)
    {

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
        $manager = $this->managers->getManagerOf('Connection');
        $account = new Account($manager->account($_SESSION['nameAccount']));
        $this->page->addVar('account', $account);

        if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
            $tailleMax = 2097152;
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if ($_FILES['avatar']['size'] <= $tailleMax) {
                $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
                if (in_array($extensionUpload, $extensionsValides)) {
                    $chemin = 'membres/avatars/' . $account->id() . '.' . $extensionUpload;
                    $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                    if ($resultat) {
                        $manager->updateAvatar($account->id(), $extensionUpload);
                        $this->app->httpResponse()->redirect('/moncompte');
                    } else {
                        $this->app->user()->setFlash('Il y a eu une erreur durant l\'important de votre photo de profil.');
                    }
                } else {
                    $this->app->user()->setFlash('Votre photo de profil doit être au format jpg, jpeg, gif ou png.');
                }
            } else {
                $this->app->user()->setFlash('Votre photo de profil ne doit pas dépasser 2Mo.');
            }
        }
    }

    public function executeDeconnexion()
    {
        $this->app->user()->setAuthenticated(false, "noaccount");
        $this->app->httpResponse()->redirect('.');
    }
}
