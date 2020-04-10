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
        $this->page->addVar('partieLancer', false);
        $this->page->addVar('title', 'Jeu');
        $manager = $this->managers->getManagerOf('Connection');
        $managerGame = $this->managers->getManagerOf('Game');
        $account = new Account($manager->account($_SESSION['nameAccount']));
        $game = new Game($managerGame->game($account->id()));
        $this->page->addVar('account', $account);
        $this->page->addVar('game', $game);

        if (isset($_POST['start'])) {
            $managerGame->start($account->id());
            $this->app->httpResponse()->redirect('/jeu');
        }

        if (isset($_POST['reset'])) {
            $managerGame->reset($account->id());
            $this->app->httpResponse()->redirect('/jeu');
        }

        if ($managerGame->PartieLancer($account->id())) {

            // DANS LE JEU //
            
            // $message = $managerGame->message($game->progression());
            $messages = $managerGame->ListMessages($game->progression());
            $this->page->addVar('partieLancer', true);
            $this->page->addVar('choix', false);
            $this->page->addVar('messages', $messages);

            if (isset($_POST['next'])) {
                $managerGame->advancingHistory($account->id());
                $this->app->httpResponse()->redirect('/jeu');
            }

            // DANS LE JEU //

        }
    }
}
