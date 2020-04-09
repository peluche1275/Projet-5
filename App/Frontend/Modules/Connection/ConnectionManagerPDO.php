<?php

namespace App\Frontend\Modules\Connection;

use \Framework\Manager;

class ConnectionManagerPDO extends Manager
{
    public function inscription($pseudo, $password, $email)
    {
        $q = $this->dao->prepare('INSERT INTO compte SET pseudo = :pseudo, email = :email, passwd = :passwd');

        $q->bindValue(':pseudo', $pseudo);
        $q->bindValue(':email', $email);
        $q->bindValue(':passwd', $password);

        $q->execute();
    }

    public function connexion($pseudo, $password)
    {
        $sql = 'SELECT passwd FROM compte WHERE pseudo ="' . $pseudo . '"';

        $q = $this->dao->query($sql)->fetch();

        $connect = false;

        if (password_verify($password, $q['passwd'])) {
            $connect = true;
        } else {
            $connect = false;
        }

        return $connect;
    }

    public function account($pseudo)
    {
        $sql = 'SELECT id, pseudo, avatar FROM compte WHERE pseudo ="' . $pseudo . '"';
        $q = $this->dao->query($sql)->fetch();
        $array = array('pseudo' => $q['pseudo'], 'id' => $q['id'], 'avatar' => $q['avatar']);
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
