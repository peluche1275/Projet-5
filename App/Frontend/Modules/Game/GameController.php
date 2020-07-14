<?php

namespace App\Frontend\Modules\Game;

use \Framework\BackController;
use \Entity\Account;

class GameController extends BackController
{

    // METHODS //

    public function executeGame()
    {
        $this->page->addVar('partieLancer', false);
        $this->page->addVar('title', 'Quizz !');
        $manager = $this->managers->getManagerOf('Connection');
        $manager->mustBeConnected($this->app);
        $managerGame = $this->managers->getManagerOf('Game');
        $account = new Account($manager->account($_SESSION['nameAccount']));
        $this->page->addVar('account', $account);

        if (isset($_POST['start'])) :
            $managerGame->start($account->id());
            $this->app->httpResponse()->redirect('/quizz');
        endif;

        if (isset($_POST['reset'])) :
            $managerGame->reset($account->id());
            $this->app->httpResponse()->redirect('/quizz');
        endif;

        if ($managerGame->PartieLancer($account->id())) :
            $this->page->addVar('partieLancer', true);
        endif;
    }

    public function executeLeaderboard()
    {
        $this->page->addVar('title', 'Leaderboard');
        $manager = $this->managers->getManagerOf('Connection');
        $manager->mustBeConnected($this->app);
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

        for ($i = 0; $i <= 5; $i++) :
            $i2 = 5 - $i;
            isset($messages[$i]['contenu']) ? ${"message" . $i2} = $messages[$i]['contenu'] : ${"message" . $i2} = "";
        endfor;

        $res = ["lastpage" => $lastpage, "score" => $score, "fin" => $fin, "page" => $page, "choix1" => $choices['choix1'], "choix2" => $choices['choix2'], "message5" => $message5, "message4" => $message4, "message3" => $message3, "message2" => $message2, "message1" => $message1, "points" => $data['points'], "progression" => $progression];
        echo json_encode($res);
    }
}
