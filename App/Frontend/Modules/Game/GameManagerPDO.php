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
        if($progression>=5)
        {
            $progression2 = $progression-4;
            $sql = 'SELECT contenu FROM scenario1 WHERE id>='. '\''. $progression2 . '\''. 'LIMIT 0,5';
        }
        else 
        {
            $sql = 'SELECT contenu FROM scenario1 LIMIT 0,' .$progression;
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
        $sql = 'SELECT choix1, choix2 FROM scenario1 WHERE id =' .$progression;
        $q = $this->dao->query($sql)->fetch();
        return $q;
    }

    public function choice($choix,$progression,$id)
    {
        $sql = 'SELECT o'.$choix.',s'.$choix.',a'.$choix.' FROM scenario1 WHERE id =' .$progression;
        $q = $this->dao->query($sql)->fetch();
        $sql = 'UPDATE partie SET otages = otages+'.$q['o'.$choix].', soldats = soldats+'.$q['s'.$choix].', argents = argents+'.$q['a'.$choix].' WHERE idcompte = '.$id;
        $this->dao->exec($sql);
    }

    public function advancingHistory($id)
    {
        $sql = 'UPDATE partie SET progression=progression+1 WHERE idcompte ="' . $id . '"';
        $this->dao->exec($sql);
    }
}
