<?php 

namespace App\Frontend\Modules\Connection;

use \Framework\Manager;

class ConnectionManagerPDO extends Manager
{
    public function inscription($pseudo,$password,$email)
    {
        $q = $this->dao->prepare('INSERT INTO compte SET pseudo = :pseudo, email = :email, passwd = :passwd');

        $q->bindValue(':pseudo', $pseudo);
        $q->bindValue(':email', $email);
        $q->bindValue(':passwd', $password);

        $q->execute();
    }

    public function connexion($pseudo,$password)
    {
        $sql = 'SELECT passwd FROM compte WHERE pseudo ="' . $pseudo .'"';

        $q = $this->dao->query($sql)->fetch();

        if(password_verify($password,$q['passwd']))
        {
            echo 'ça marche!';
        }
        else
        {
            echo'ça marche pas!';
        }
    }
}