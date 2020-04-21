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

            if (isset($_POST['choix1'])) :
                $managerGame->choice(1, $game->progression(), $account->id());
                $managerGame->advancingHistory($account->id());
                $this->app->httpResponse()->redirect('/jeu');
            endif;

            if (isset($_POST['choix2'])) :
                $managerGame->choice(2, $game->progression(), $account->id());
                $managerGame->advancingHistory($account->id());
                $this->app->httpResponse()->redirect('/jeu');
            endif;

        endif;
    }

    public function executeGameAjax()
    {
        $dao = PDOFactory::getMysqlConnexion();
        $choix = $_GET['choix'];
        $id = $_GET['id'];

        // Récuperation de la Progression de l'user //
        $sql = 'SELECT progression FROM partie WHERE idcompte =' . $id;
        $q = $dao->query($sql)->fetch();
        $progression = $q['progression'];
        $progressionSuite = $progression + 1;

        // Récupération des choix pour les afficher //
        $sql2 = 'SELECT contenu,choix1,choix2 FROM scenario1 WHERE id=' . $progressionSuite;
        $q2 = $dao->query($sql2)->fetch();

        // Avancer la progression du joueur //
        $sql3 = 'UPDATE partie SET progression=progression+1 WHERE idcompte ="' . $id . '"';
        $dao->exec($sql3);

        // Récuperer les données du scénario //
        $sql1 = 'SELECT contenu,O1,S1,A1,O2,S2,A2 FROM scenario1 WHERE id=' . $progression;
        $q1 = $dao->query($sql1)->fetch();

        // Choix //

        $sql4 = 'SELECT o' . $choix . ',s' . $choix . ',a' . $choix . ' FROM scenario1 WHERE id =' . $progression;
        $q4 = $dao->query($sql4)->fetch();
        $sql5 = 'UPDATE partie SET otages = otages+' . $q4['o' . $choix] . ', soldats = soldats+' . $q4['s' . $choix] . ', argents = argents+' . $q4['a' . $choix] . ' WHERE idcompte = ' . $id;
        $dao->exec($sql5);

        // Récupération des données afin de les afficher //
        $sql6 = 'SELECT otages,soldats,argents FROM partie WHERE idcompte=' . $id;
        $q6 = $dao->query($sql6)->fetch();


        // Récupération des messages //
        $message4 = "";
        $message3 = "";
        $message2 = "";
        $message1 = "";
        // Récupération du message 4 //
        if ($progression > 0) :
            $sql7 = 'SELECT contenu FROM scenario1 WHERE id = ' . $progression;
            $q7 = $dao->query($sql7)->fetch();
            $message4 = $q7['contenu'];
        endif;
        // Récupération du message 3 //
        if ($progression > 1) :
            $sql8 = 'SELECT contenu FROM scenario1 WHERE id = ' . $progression . '-1';
            $q8 = $dao->query($sql8)->fetch();
            $message3 = $q8['contenu'];
        endif;
        // Récupération du message 2 //
        if ($progression > 2) :
            $sql9 = 'SELECT contenu FROM scenario1 WHERE id = ' . $progression . '-2';
            $q9 = $dao->query($sql9)->fetch();
            $message2 = $q9['contenu'];
        endif;
        // Récupération du message 1 //
        if ($progression > 3) :
            $sql10 = 'SELECT contenu FROM scenario1 WHERE id = ' . $progression . '-3';
            $q10 = $dao->query($sql10)->fetch();
            $message1 = $q10['contenu'];
        endif;


        $res = ["choix1" => $q2['choix1'], "choix2" => $q2['choix2'], "message5" => $q2['contenu'], "message4" => $message4, "message3" => $message3, "message2" => $message2, "message1" => $message1, "otages" => $q6['otages'], "soldats" => $q6['soldats'], "argents" => $q6['argents']];


        echo json_encode($res);
    }
}
