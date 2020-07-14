<?php

namespace App\Frontend\Modules\Game;

use \Framework\Manager;

class GameManagerPDO extends Manager
{

    public function PartieLancer($id)
    {
        $sql = 'SELECT lancer FROM partie WHERE idcompte ="' . $id . '"';

        $q = $this->dao->query($sql)->fetch();

        return $q["lancer"];
    }

    public function start($id)
    {
        $sql = 'UPDATE partie SET points = 0, lancer = 1, progression = 1 WHERE idcompte ="' . $id . '"';

        $this->dao->exec($sql);
    }

    public function reset($id)
    {
        $sql = 'UPDATE partie SET points = 0, lancer = 0, progression = 0 WHERE idcompte ="' . $id . '"';

        $this->dao->exec($sql);
    }

    public function generateLeaderboard()
    {
        $sql = 'SELECT pseudo, avatar , bestscore FROM compte ORDER BY bestscore DESC LIMIT 0,10';
        return $this->dao->query($sql)->fetchAll();
    }


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
        $sql = 'SELECT a' . $choix . ' FROM scenario1 WHERE id =' . $progression;
        $q = $this->dao->query($sql)->fetch();
        $sql2 = 'UPDATE partie SET points = points+' . $q['a' . $choix] . ' WHERE idcompte = ' . $id;
        $this->dao->exec($sql2);
    }

    public function getDataAjax($id)
    {
        $sql = 'SELECT points FROM partie WHERE idcompte=' . $id;
        return $this->dao->query($sql)->fetch();
    }

    public function scoreAjax($id)
    {
        $sql = 'SELECT points FROM partie WHERE idcompte=' . $id;
        $q = $this->dao->query($sql)->fetch();
        $points = $q['points'];
        $score = $points;
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
