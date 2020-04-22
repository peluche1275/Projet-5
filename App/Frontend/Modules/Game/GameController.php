<?php

namespace App\Frontend\Modules\Game;

use \Framework\BackController;
use \Framework\HTTPRequest;
use \Entity\Account;
use \Entity\Game;
use Framework\PDOFactory;

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
        endif;
    }

    public function executeGameAjax()
    {
        $choix = $_GET['choix'];
        $id = $_SESSION['id'];
        $manager = $this->managers->getManagerOf('Game');
        $progression = $manager->userProgressAjax($id);
        $next = $manager->nextMessageAjax($progression);
        $manager->advancingProgressAjax($id);
        $manager->applyChoiceAjax($choix,$progression,$id);
        $data = $manager->getDataAjax($id);
        $messages = $manager->getMessagesAjax($progression);


        // Récupération des messages //
        $message4 = "";
        $message3 = "";
        $message2 = "";
        $message1 = "";
        // Récupération du message 4 //
        if ($progression > 0) :
            $message4 = $messages[1]['contenu'];
        endif;
        // Récupération du message 3 //
        if ($progression > 1) :
            $message3 = $messages[2]['contenu'];
        endif;
        // Récupération du message 2 //
        if ($progression > 2) :
            $message2 = $messages[3]['contenu'];
        endif;
        // Récupération du message 1 //
        if ($progression > 3) :
            $message1 = $messages[4]['contenu'];
        endif;

        $res = ["choix1" => $next['choix1'], "choix2" => $next['choix2'], "message5" => $next['contenu'], "message4" => $message4, "message3" => $message3, "message2" => $message2, "message1" => $message1, "otages" => $data['otages'], "soldats" => $data['soldats'], "argents" => $data['argents']];

        echo json_encode($res);
    }
}
