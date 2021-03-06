<?php

namespace App\Frontend\Modules\Connection;

use \Framework\Manager;

class ConnectionManagerPDO extends Manager
{
    public function verification($pseudo, $champ)
    {
        $sql = 'SELECT COUNT(*) AS bool FROM compte WHERE ' . $champ . ' LIKE "' . $pseudo . '"';
        $q = $this->dao->query($sql)->fetch();
        return $q['bool'];
    }

    public function mustBeConnected($app)
    {
        if (!isset($_SESSION['nameAccount'])) :
            $app->httpResponse()->redirect('login');
        endif;
    }

    public function mustBeUnconnected($app)
    {
        if (isset($_SESSION['nameAccount'])) :
                $app->httpResponse()->redirect('.');
        endif;
    }


    public function testPassword($mdp)
    {
        $longueur = strlen($mdp);
        $point = 0;
        $point_min = 0;
        $point_maj = 0;
        $point_chiffre = 0;
        $point_caracteres = 0;
        for ($i = 0; $i < $longueur; $i++) :
            $lettre = $mdp[$i];
            if ($lettre >= 'a' && $lettre <= 'z') :
                $point = $point + 1;
                $point_min = 1;
            elseif ($lettre >= 'A' && $lettre <= 'Z') :
                $point = $point + 2;
                $point_maj = 2;
            elseif ($lettre >= '0' && $lettre <= '9') :
                $point = $point + 3;
                $point_chiffre = 3;
            else :
                $point = $point + 5;
                $point_caracteres = 5;
            endif;

            $occurences = substr_count($mdp, $lettre);
            if ($occurences > 1) :
                $penalite = $occurences * 2;
                $point = $point - $penalite;
            endif;
        endfor;
        $etape1 = $point / $longueur;
        $etape2 = $point_min + $point_maj + $point_chiffre + $point_caracteres;
        $resultat = $etape1 * $etape2;
        $final = $resultat * $longueur;
        if ($final > 40) :
            return true;
        else :
            return false;
        endif;
    }

    public function inscription($pseudo, $password, $email)
    {
        $q = $this->dao->prepare('INSERT INTO compte SET pseudo = :pseudo, email = :email, passwd = :passwd, avatar = :avatar');

        $q->bindValue(':pseudo', $pseudo);
        $q->bindValue(':email', $email);
        $q->bindValue(':passwd', $password);
        $q->bindValue(':avatar', "membres/avatars/default.png");

        $q->execute();

        $sql = 'SELECT id FROM compte WHERE pseudo ="' . $pseudo . '"';
        $q2 = $this->dao->query($sql)->fetch();

        $this->dao->exec('INSERT INTO partie SET idcompte = ' . $q2['id']);
    }

    public function connexion($pseudo, $password)
    {
        $sql = 'SELECT passwd FROM compte WHERE pseudo ="' . $pseudo . '"';

        $q = $this->dao->query($sql)->fetch();

        $connect = false;

        if (password_verify($password, $q['passwd'])) :
            $connect = true;
        else :
            $connect = false;
        endif;

        return $connect;
    }

    public function account($pseudo)
    {
        $sql = 'SELECT id, pseudo, avatar,bestscore FROM compte WHERE pseudo ="' . $pseudo . '"';
        $q = $this->dao->query($sql)->fetch();
        $array = array('pseudo' => $q['pseudo'], 'id' => $q['id'], 'avatar' => $q['avatar'], 'score' => $q['bestscore']);
        return $array;
    }

    public function updateAvatar($id, $extensionUpload)
    {
        $sql = 'UPDATE compte SET avatar = :avatar WHERE id = :id';
        $this->dao->prepare($sql)->execute(array(
            'avatar' => 'membres/avatars/' . $id . '.' . $extensionUpload,
            'id' => $id
        ));
    }
}
