<?php

namespace App\Frontend\Modules\Game;

use \Framework\Manager;

class GameManagerPDO extends Manager
{

    // METHODS //

    public function PartieLancer($id)
    {
        $sql = 'SELECT lancer FROM partie WHERE idcompte ="' . $id . '"';

        $q = $this->dao->query($sql)->fetch();

        return $q["lancer"];
    }

    public function start($id)
    {
        $sql = 'UPDATE partie SET otages = 50, soldats = 200, argents = 1000000, lancer = 1, progression = 1 WHERE idcompte ="' . $id . '"';

        $this->dao->exec($sql);
    }

    public function reset($id)
    {
        $sql = 'UPDATE partie SET otages = 0, soldats = 0, argents = 0, lancer = 0, progression = 0 WHERE idcompte ="' . $id . '"';

        $this->dao->exec($sql);
    }

    public function game($id)
    {
        $sql = 'SELECT otages, soldats, argents,progression FROM partie WHERE idcompte ="' . $id . '"';
        $q = $this->dao->query($sql)->fetch();
        $array = array('otages' => $q['otages'], 'soldats' => $q['soldats'], 'argents' => $q['argents'], 'progression' => $q['progression']);
        return $array;
    }

    public function message($progression)
    {
        $sql = 'SELECT contenu FROM scenario1 WHERE id ="' . $progression . '"';
        $q = $this->dao->query($sql)->fetch();
        $message = $q['contenu'];
        return $message;
    }

    public function ListMessages($progression)
    {
        if ($progression >= 5) {
            $progression2 = $progression - 4;
            $sql = 'SELECT contenu FROM scenario1 WHERE id>=' . '\'' . $progression2 . '\'' . 'LIMIT 0,5';
        } else {
            $sql = 'SELECT contenu FROM scenario1 LIMIT 0,' . $progression;
        }

        $q = $this->dao->query($sql)->fetchAll();
        return $q;
    }

    public function ListMessagesAjax()
    {
        $sql = 'SELECT id,contenu FROM scenario1';
        $q = $this->dao->query($sql)->fetchAll();
        return $q;
    }

    public function showChoices($progression)
    {
        $sql = 'SELECT choix1, choix2 FROM scenario1 WHERE id =' . $progression;
        $q = $this->dao->query($sql)->fetch();
        return $q;
    }

    public function choice($choix, $progression, $id)
    {
        $sql = 'SELECT o' . $choix . ',s' . $choix . ',a' . $choix . ' FROM scenario1 WHERE id =' . $progression;
        $q = $this->dao->query($sql)->fetch();
        $sql = 'UPDATE partie SET otages = otages+' . $q['o' . $choix] . ', soldats = soldats+' . $q['s' . $choix] . ', argents = argents+' . $q['a' . $choix] . ' WHERE idcompte = ' . $id;
        $this->dao->exec($sql);
    }

    public function advancingHistory($id)
    {
        $sql = 'UPDATE partie SET progression=progression+1 WHERE idcompte ="' . $id . '"';
        $this->dao->exec($sql);
    }

    public function generateLeaderboard()
    {
        $sql = 'SELECT pseudo, avatar , bestscore FROM compte ORDER BY bestscore DESC LIMIT 0,10';
        return $this->dao->query($sql)->fetchAll();
    }

    // AJAX METHODS //

    public function userProgressAjax($id)
    {
        $sql = 'SELECT progression FROM partie WHERE idcompte =' . $id;
        $q = $this->dao->query($sql)->fetch();
        return $q['progression'];
    }

    public function advancingProgressAjax($id)
    {
        $sql = 'UPDATE partie SET progression=progression+1 WHERE idcompte ="' . $id . '"';
        $this->dao->exec($sql);
    }

    public function applyChoiceAjax($choix, $progression, $id)
    {
        $sql = 'SELECT o' . $choix . ',s' . $choix . ',a' . $choix . ' FROM scenario1 WHERE id =' . $progression;
        $q = $this->dao->query($sql)->fetch();
        $sql2 = 'UPDATE partie SET otages = otages+' . $q['o' . $choix] . ', soldats = soldats+' . $q['s' . $choix] . ', argents = argents+' . $q['a' . $choix] . ' WHERE idcompte = ' . $id;
        $this->dao->exec($sql2);
    }

    public function getDataAjax($id)
    {
        $sql = 'SELECT otages,soldats,argents FROM partie WHERE idcompte=' . $id;
        return $this->dao->query($sql)->fetch();
    }

    public function scoreAjax($id)
    {
        $sql = 'SELECT otages,soldats,argents FROM partie WHERE idcompte=' . $id;
        $q = $this->dao->query($sql)->fetch();
        $otages = $q['otages'];
        $soldats = $q['soldats'];
        $argents = $q['argents'];
        $score = $argents + $soldats * 235 + $otages * 534;
        return $score;
    }

    public function checkBestScoreAjax($score, $id)
    {
        $sql = 'SELECT bestscore FROM compte WHERE id=' . $id;
        $q = $this->dao->query($sql)->fetch();
        $bestscore = $q['bestscore'];
        if ($score > $bestscore) :
            $sql2 = 'UPDATE compte SET bestscore =' . $score . ' WHERE id=' . $id;
            $this->dao->exec($sql2);
        endif;
    }

    public function choicesAjax($progression)
    {
        $sql = 'SELECT choix1,choix2 FROM scenario1 WHERE id=' . $progression;
        return $this->dao->query($sql)->fetch();
    }

    public function getMessagesAjax($progression)
    {
        $sql = 'SELECT contenu FROM scenario1 WHERE id <=' . $progression . ' ORDER BY id DESC';
        return $this->dao->query($sql)->fetchAll();
    }

    public function verificationAjax($progression)
    {
        $sql = 'SELECT COUNT(*) AS bool FROM scenario1 WHERE id=' . $progression;
        $q = $this->dao->query($sql)->fetch();
        return $q['bool'];
    }
}
