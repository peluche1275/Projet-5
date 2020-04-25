<?php

namespace App\Frontend\Modules\Game;

use \Framework\BackController;
use \Entity\Account;
use \Entity\Game;

class GameController extends BackController
{

    // METHODS //

    public function executeGame()
    {
        $this->page->addVar('partieLancer', false);
        $this->page->addVar('title', 'En Jeu');
        $manager = $this->managers->getManagerOf('Connection');
        $managerGame = $this->managers->getManagerOf('Game');
        $account = new Account($manager->account($_SESSION['nameAccount']));
        $this->page->addVar('account', $account);

        if (isset($_POST['start'])) :
            $managerGame->start($account->id());
            $this->app->httpResponse()->redirect('/jeu');
        endif;

        if (isset($_POST['reset'])) :
            $managerGame->reset($account->id());
            $this->app->httpResponse()->redirect('/jeu');
        endif;

        if ($managerGame->PartieLancer($account->id())) :
            $this->page->addVar('partieLancer', true);
        endif;
    }

    public function executeLeaderboard()
    {
        $this->page->addVar('title', 'Leaderboard');
        $manager = $this->managers->getManagerOf('Connection');
        $account = new Account($manager->account($_SESSION['nameAccount']));
        $managerGame = $this->managers->getManagerOf('Game');
        $leaderboard = $managerGame->generateLeaderboard();
        $this->page->addVar('account', $account);
        $this->page->addVar('leaderboard', $leaderboard);
    }

    public function executeGameAjax()
    {
        $lastpage = true;
        $id = $_SESSION['id'];
        $manager = $this->managers->getManagerOf('Game');
        $progression = $manager->userProgressAjax($id);
        $page = $_GET['page'];
        $fin = true;
        $score = 0;

        if ($page == 0) :
            if (isset($_GET['choix'])) :
                $choix = $_GET['choix'];
                $manager->advancingProgressAjax($id);
                $manager->applyChoiceAjax($choix, $progression, $id);
                $progression = $manager->userProgressAjax($id);
            endif;
        else :
            $progression = $progression - 5 * $page;
            $check = $progression - 6;
            if ($check < 0) :
                $lastpage = false;
            endif;
        endif;

        if ($manager->verificationAjax($progression)) :
            $choices = $manager->choicesAjax($progression);
            $data = $manager->getDataAjax($id);
            $messages = $manager->getMessagesAjax($progression);
        elseif ($page == 0) :
            $choices = $manager->choicesAjax(1);
            $data = $manager->getDataAjax($id);
            $messages = $manager->getMessagesAjax(1);
            $score = $manager->scoreAjax($id);
            $manager->checkBestScoreAjax($score, $id);
            $fin = false;
        endif;

        // Récupération des messages //
        $message5 = "";
        $message4 = "";
        $message3 = "";
        $message2 = "";
        $message1 = "";

        if (isset($messages[0]['contenu'])) :
            $message5 = $messages[0]['contenu'];
        endif;

        if (isset($messages[1]['contenu'])) :
            $message4 = $messages[1]['contenu'];
        endif;
        if (isset($messages[2]['contenu'])) :
            $message3 = $messages[2]['contenu'];
        endif;
        if (isset($messages[3]['contenu'])) :
            $message2 = $messages[3]['contenu'];
        endif;
        if (isset($messages[4]['contenu'])) :
            $message1 = $messages[4]['contenu'];
        endif;

        $res = ["lastpage" => $lastpage, "score" => $score, "fin" => $fin, "page" => $page, "choix1" => $choices['choix1'], "choix2" => $choices['choix2'], "message5" => $message5, "message4" => $message4, "message3" => $message3, "message2" => $message2, "message1" => $message1, "otages" => $data['otages'], "soldats" => $data['soldats'], "argents" => $data['argents'], "progression" => $progression];
        echo json_encode($res);
    }
}
