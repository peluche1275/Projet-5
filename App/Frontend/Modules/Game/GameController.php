<?php

namespace App\Frontend\Modules\Game;

use \Framework\BackController;
use \Framework\HTTPRequest;
use \Entity\Account;
use \Entity\Game;

class GameController extends BackController
{

    // METHODS //

    public function executeGame()
    {
        // Préparation du jeu //
        $this->page->addVar('partieLancer', false);
        $this->page->addVar('title', 'Jeu');
        $manager = $this->managers->getManagerOf('Connection');
        $managerGame = $this->managers->getManagerOf('Game');
        $account = new Account($manager->account($_SESSION['nameAccount']));
        $game = new Game($managerGame->game($account->id()));
        $this->page->addVar('account', $account);
        $this->page->addVar('game', $game);

        // Lancer le jeu //
        if (isset($_POST['start'])) :
            $managerGame->start($account->id());
            $this->app->httpResponse()->redirect('/jeu');
        endif;

        // Réinitatiliser le jeu //
        if (isset($_POST['reset'])) :
            $managerGame->reset($account->id());
            $this->app->httpResponse()->redirect('/jeu');
        endif;

        // Si la partie est lancer
        if ($managerGame->PartieLancer($account->id())) :
            $messages = $managerGame->ListMessages($game->progression());
            $this->page->addVar('partieLancer', true);
            $this->page->addVar('messages', $messages);
            $choix1 = $managerGame->showChoices($game->progression())['choix1'];
            $choix2 = $managerGame->showChoices($game->progression())['choix2'];
            $this->page->addVar('choix1', $choix1);
            $this->page->addVar('choix2', $choix2);

            if (isset($_POST['choix1'])) :
                $managerGame->choice(1,$game->progression(),$account->id());
                $managerGame->advancingHistory($account->id());
                $this->app->httpResponse()->redirect('/jeu');
            endif;

            if (isset($_POST['choix2'])) :
                $managerGame->choice(2,$game->progression(),$account->id());
                $managerGame->advancingHistory($account->id());
                $this->app->httpResponse()->redirect('/jeu');
            endif;


        // $_GET['messages'] = $managerGame->ListMessagesAjax();
        // $this->page->addVar('partieLancer', true);
        // $this->page->addVar('choix', false);

        // if (isset($_POST['next'])) :
        //     $managerGame->advancingHistory($account->id());
        // endif;

        endif;
    }
}
